<?php

namespace Adaptdk\PimApi\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The event instance
     */
    public $event;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event;
    }
}
