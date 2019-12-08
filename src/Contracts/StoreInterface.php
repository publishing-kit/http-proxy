<?php

declare(strict_types=1);

namespace PublishingKit\HttpProxy\Contracts;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

interface StoreInterface
{
    public function has(ServerRequestInterface $request): bool;

    public function get(ServerRequestInterface $request): ?string;

    public function put(ServerRequestInterface $request, ResponseInterface $response): void;
}
