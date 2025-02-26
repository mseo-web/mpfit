<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'description', 'price'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Добавляем аксессор для форматирования цены
    public function getPriceFormattedAttribute()
    {
        return number_format($this->price, 2, '.', ' ') . ' ₽';
    }
}
