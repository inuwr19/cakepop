<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Payment;
use GuzzleHttp\Client;

class CheckMidtransPaymentStatus extends Command
{
    protected $signature = 'payment:check-status';
    protected $description = 'Check payment status from Midtrans API periodically';

    public function handle()
    {
        $client = new Client();
        $serverKey = config('services.midtrans.server_key');

        // Ambil semua transaksi dengan status pending
        $payments = Payment::where('status', 'pending')->get();

        foreach ($payments as $payment) {
            $url = "https://api.sandbox.midtrans.com/v2/{$payment->order_id}/status";

            try {
                $response = $client->request('GET', $url, [
                    'headers' => [
                        'Authorization' => 'Basic ' . base64_encode($serverKey . ':'),
                        'Content-Type' => 'application/json',
                    ],
                ]);

                $result = json_decode($response->getBody()->getContents(), true);

                switch ($result['transaction_status']) {
                    case 'settlement':
                        $payment->status = 'success';
                        break;
                    case 'pending':
                        $payment->status = 'pending';
                        break;
                    case 'expire':
                        $payment->status = 'expired';
                        break;
                    case 'cancel':
                        $payment->status = 'failed';
                        break;
                }

                $payment->payment_method = $result['payment_type'];
                $payment->save();

                $this->info("Payment ID {$payment->order_id} updated!");
            } catch (\Exception $e) {
                $this->error("Failed to update payment ID {$payment->order_id}: {$e->getMessage()}");
            }
        }
    }


}
