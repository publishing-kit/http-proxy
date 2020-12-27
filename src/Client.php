<?php

declare(strict_types=1);

namespace PublishingKit\HttpProxy;

use Http\Client\HttpClient;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class Client implements HttpClient
{
    /**
     * @var callable
     * @psalm-var callable(RequestInterface): ResponseInterface
     */
    private $callback;

    /**
     * @param callable $callback
     * @psalm-param callable(RequestInterface): ResponseInterface $callback
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * {@inheritDoc}
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        return $this->callback($request);
    }
}
