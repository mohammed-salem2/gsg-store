<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $user;
    // protected $order;
    /**
     * Create a new event instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->user = auth()->user();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('orders'),
        ];
    }

    public function broadcastWith()
    {
        return [
            'order' => [
                'id' => $this->order->id,
                'number' => $this->order->serial_number,
            ],
        ];
    } //هاي الميثود بستخدمها في تحديد البيانات لبدي اعرضها في الايفنت في حال مكنتش هبعت كل البيانات
    public function broadcastAs()
    {
        return 'order.created';
    } // عشان اعمل كاستمايز لاسم الايفنت لو بديش ياه نفس اسم الايفنت
}
// في البوردكاست بعرضلي البيانات لبكون معرفها بابليك في الايفنت بس
