<?php

namespace App\Models;

use App\Observers\OrderObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_number',
        'user_id',
        'shipping',
        'discount',
        'tax',
        'total',
        'status',
        'payment_status',
        'billing_name',
        'billing_phone',
        'billing_email',
        'billing_address',
        'billing_city',
        'billing_country',
        'shipping_name',
        'shipping_phone',
        'shipping_email',
        'shipping_address',
        'shipping_city',
        'shipping_country',
        'notes',
    ];

    protected static function booted()
    {
        static::observe(OrderObserver::class);
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->hasMany(OrderItem::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class , 'order_items')
        ->using(OrderItem::class)
        ->as('items')
        ->withPivot(['quantity' , 'price']);
    }
}
