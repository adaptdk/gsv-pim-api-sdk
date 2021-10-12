<?php

namespace Adapt\PimApi\Endpoints;

use Adapt\PimApi\BasePimService;
use \Illuminate\Http\Client\Response;

class Category extends BasePimService
{
    public function get(string $code) : Response
    {
        $this->method = 'GET';
        $this->path = '/v1/categories/%s';

        return $this->withPath([$code])->send();
    }

    public function paginate(int $page = 1) : Response
    {
        $this->method = 'GET';
        $this->path = '/v1/categories';

        return $this->withQuery(['category' => 'master', 'page' => $page])->send();
    }
}
