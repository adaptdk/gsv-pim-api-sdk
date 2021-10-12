<?php

namespace Adaptdk\PimApi\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckWebhook
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle(Request $request, Closure $next): mixed
    {
        // Prepare the event payload.
        $signedPayload = $request->getContent();

        // Generate a hash signature.
        $generatedSignature = hash_hmac("sha256", $signedPayload, config('webhook.secret'));

        // Compare the original and generated signature.
        if (! hash_equals($request->headers->get('signature'), $generatedSignature)) {
            throw new \Exception("Invalid signature for akeneo webhook");
        }

        return $next($request);
    }
}
