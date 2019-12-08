<?php

declare(strict_types=1);

namespace PublishingKit\HttpProxy\Store;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use PublishingKit\HttpProxy\Contracts\StoreInterface;
use Psr\Cache\CacheItemPoolInterface;

final class Psr6Store implements StoreInterface
{
    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    public function __construct(CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;
    }

    public function has(ServerRequestInterface $request): bool
    {
        $key = $this->getCacheKey($request);
        $item = $this->cache->getItem($key);
        return $item->isHit();
    }

    public function get(ServerRequestInterface $request): ?string
    {
        $key = $this->getCacheKey($request);
        $item = $this->cache->getItem($key);
        if ($item->isHit()) {
            return $item->get();
        }
        return null;
    }

    public function put(ServerRequestInterface $request, ResponseInterface $response): void
    {
        $key = $this->getCacheKey($request);
        $item = $this->cache->getItem($key);
        $item->set($response->getBody()->__toString());
        $this->cache->save($item);
    }

    private function getCacheKey(ServerRequestInterface $request): string
    {
        $uri = $request->getUri();
        return 'cached-'
            . trim($uri->getPath(), '/')
            . ($uri->getQuery() ? '?' . $uri->getQuery() : '')
            . '.html';
    }
}
