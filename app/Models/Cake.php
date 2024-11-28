<?php

namespace App\Models;

use Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cake extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'size', 'image', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

