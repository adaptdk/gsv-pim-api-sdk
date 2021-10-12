<?php

namespace Adaptdk\PimApi\Controllers;

use Adaptdk\PimApi\Events\ProductCreated;
use Adaptdk\PimApi\Events\ProductDeleted;
use Adaptdk\PimApi\Events\ProductUpdated;
use Adaptdk\PimApi\Middleware\CheckWebhook;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class WebhookController extends Controller
{
    /**
     * @var string[]
     */
    protected $middleware = [
        CheckWebhook::class
    ];

    /**
     * Subscribe to the webhook
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function subscribe(Request $request): Response
    {
        collect($request->get('events'))->each(function ($event) use ($request) {
            if (! data_get($event, 'data.resource')) {
                throw new \Exception('No resource provided by webhook');
            }

            return match (data_get($event, 'action')) {
                'product.updated' => event(new ProductUpdated($event)),
                'product.created' => event(new ProductCreated($event)),
                'product.removed' => event(new ProductDeleted($event)),
            };
        });

        return response(['message' => 'Successful subscription to webhook']);
    }
}
