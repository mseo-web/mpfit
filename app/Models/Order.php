<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'created_at',
        'status',
        'comment',
        'product_id',
        'quantity',
        'total_price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $product = Product::find($order->product_id);
            $order->total_price = $product->price * $order->quantity;
        });
    }
}
