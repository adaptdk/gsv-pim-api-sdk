<?php

namespace Adapt\PimApi\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class WebhookController extends Controller
{
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
                'product.updated' => event(),
                'product.created' => event(),
                'product.removed' => event(),
            };
        });

        return response(['message' => 'Successful subscription to webhook']);
    }
}
