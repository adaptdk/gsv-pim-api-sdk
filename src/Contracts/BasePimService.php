<?php

namespace Adaptdk\PimApi\Contracts;

interface BasePimService
{
    public function withData($data = []): static;

    public function withPath(array $pathVariable): static;
}
