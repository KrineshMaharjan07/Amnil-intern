<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{


    protected $table = 'products';

    protected $fillable = ['title', 'price', 'status', 'quantity', 'order','category_id'];
    public $timestamps = true; // ✅ Disable timestamp
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
