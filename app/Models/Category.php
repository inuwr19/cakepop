<?php

namespace App\Models;

use App\Models\Cake;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function cakes()
    {
        return $this->hasMany(Cake::class);
    }
}
