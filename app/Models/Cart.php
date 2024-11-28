<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'cake_id', 'quantity'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cake()
    {
        return $this->belongsTo(Cake::class);
    }
}
