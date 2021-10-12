<?php

namespace Adaptdk\PimApi;

use Adaptdk\PimApi\Middleware\TokenMiddleware;
use Illuminate\Http\Client\Factory as HttpFactory;
use JustSteveKing\Transporter\Request;

class BasePimService extends Request
{
    public function __construct(HttpFactory $http)
    {
        parent::__construct($http);

        $this->setBaseUrl(config('base'));
        $this->request->withMiddleware(new TokenMiddleware($this));
    }

    public function withPath(array $pathVariable): static
    {
        $this->setPath(vsprintf($this->path, $pathVariable));

        return $this;
    }
}
