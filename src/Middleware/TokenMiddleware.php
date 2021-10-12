<?php

namespace Adapt\PimApi\Middleware;

use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\RequestInterface;

class TokenMiddleware
{
    /**
     * @var
     */
    private $request;

    /**
     * TokenMiddleware constructor.
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Invoke the middleware
     *
     * @param  callable  $next
     *
     * @return \Closure
     */
    public function __invoke(callable $next) : \Closure
    {
        return function ($request, array $options = []) use ($next) {
            $request = $this->handle($request);
            return $next($request, $options);
        };
    }

    public function handle(Request $request)
    {
        if (!Cache::has('pim_api_token')) {
            $response = Http::withHeaders([
                'content-type' => 'application/json'
            ])->post(config('services.pim_api.audience_auth_endpoint'), [
                'client_id' => config('services.pim_api.client_id'),
                'client_secret' => config('services.pim_api.client_secret'),
                'audience' => config('services.pim_api.audience_api_endpoint'),
                'grant_type' => config('services.pim_api.grant_type')
            ]);
            $data = $response->collect();
            Cache::put('pim_api_token',$data->get('access_token'), $data->get('expires_in'));
        }

        return $request->withHeader('Authorization', sprintf('Bearer %s', trim(Cache::get('pim_api_token'))));
    }
}
