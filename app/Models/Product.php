<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, softDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'estates_id',
        'image'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }

}
