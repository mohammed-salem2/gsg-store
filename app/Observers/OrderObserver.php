<?php

namespace App\Observers;

use App\Models\Order;
use Illuminate\Support\Carbon;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "created" event.
     */
    public function creating(Order $order): void
    {
            $now = Carbon::now();
            $number = Order::whereYear('created_at' , '=' , $now->year)->max('serial_number');
            $order->serial_number = $number ? $number + 1 : $now->year . '0001';

            if(!$order->shipping_name){
                $order->shipping_name = $order->billing_name;
            }
            if(!$order->shipping_email){
                $order->shipping_email = $order->billing_email;
            }
            if(!$order->shipping_phone){
                $order->shipping_phone = $order->billing_phone;
            }
            if(!$order->shipping_address){
                $order->shipping_address = $order->billing_address;
            }
            if(!$order->shipping_city){
                $order->shipping_city = $order->billing_city;
            }
            if(!$order->shipping_country){
                $order->shipping_country = $order->billing_country;
            }
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
