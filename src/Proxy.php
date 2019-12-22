<?php

declare(strict_types=1);

namespace PublishingKit\HttpProxy;

use PublishingKit\HttpProxy\Contracts\StoreInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class Proxy
{
    /**
     * @var StoreInterface
     */
    private $store;

    public function __construct(StoreInterface $store)
    {
        $this->store = $store;
    }

    public function get(RequestInterface $request, callable $callback): ResponseInterface
    {
        return $callback($request);
    }
}
