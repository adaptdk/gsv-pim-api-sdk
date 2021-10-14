<?php

namespace Adaptdk\PimApi\Endpoints;

use Adaptdk\PimApi\BasePimService;
use Illuminate\Http\Client\Response;

class Product extends BasePimService
{
    public function get(string $code): Response
    {
        $this->method = 'GET';
        $this->path = '/v1/products/%s';

        return $this->withPath([$code])->send();
    }

    public function paginate(int $page = 1, $query = []): Response
    {
        $this->method = 'GET';
        $this->path = '/v1/products';
        $baseQuery = [
            'search' => [
                "categories" => [
                    [
                        "operator" => "IN CHILDREN",
                        "value" => ["master"],
                    ],

                ],
            ],
            'page' => $page,
            'limit' => 100,
        ];

        collect($query)->each(function ($value, $key) use (&$baseQuery) {
            $baseQuery['search'][$key] = $value;
        });


        return $this->withQuery($baseQuery)->send();
    }

    public function store(array $data = []): Response
    {
        $this->method = 'POST';
        $this->path = '/v1/products';

        return $this->withData($data)->send();
    }

    public function update(string $id, array $data = []): Response
    {
        $this->method = 'PATCH';
        $this->path = '/v1/products/%s';

        return $this->withPath([$id])->withData($data)->send();
    }

    public function destroy(string $id): Response
    {
        $this->method = 'DELETE';
        $this->path = '/v1/products/%s';

        return $this->withPath([$id])->send();
    }

    public function search(array $data)
    {
        $this->method = 'GET';
        $this->path = '/v1/products/%s';
    }
}
