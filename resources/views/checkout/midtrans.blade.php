@extends('layouts.customers.index')

@section('content')
    <div class="container py-5 mb-4" style="margin-top: 7rem;">
        <h3>Detail Pembayaran</h3>
        <p>Order ID: {{ $order->id }}</p>
        <p>Total Amount: Rp {{ number_format($order->total_amount, 2, ',', '.') }}</p>

        <button id="pay-button" class="btn btn-primary btn-lg mt-4">Lanjutkan Pembayaran</button>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            snap.pay('{{ $snapToken }}', {
                // Jika pembayaran sukses
                onSuccess: function(result) {
                    console.log(result);
                    alert('Pembayaran berhasil!');
                    checkPaymentStatus('{{ $order->id }}'); // Panggil fungsi cek status pembayaran
                },

                // Jika pembayaran pending
                onPending: function(result) {
                    console.log(result);
                    alert('Menunggu pembayaran Anda!');
                    checkPaymentStatus(
                        '{{ $order->id }}'
                    ); // Tetap panggil fungsi cek status untuk memantau perubahan
                },

                // Jika pembayaran gagal
                onError: function(result) {
                    console.log(result);
                    alert('Pembayaran gagal!');
                },

                // Jika popup ditutup
                onClose: function() {
                    alert('Anda menutup popup tanpa menyelesaikan pembayaran!');
                }
            });
        });

        // Fungsi AJAX untuk cek status pembayaran
        function checkPaymentStatus(orderId) {
            $.ajax({
                url: '/payment/status/' + orderId, // Endpoint yang telah kita buat sebelumnya
                type: 'GET',
                success: function(response) {
                    if (response.message === 'Status updated successfully!') {
                        // alert('Status pembayaran berhasil diperbarui!');
                        window.location.href = "{{ route('invoice.show', ['orderId' => $order->id]) }}";
                    } else {
                        alert('Status pembayaran masih pending atau gagal diperbarui.');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Gagal memperbarui status pembayaran. Coba lagi nanti.');
                }
            });
        }
    </script>
@endsection
