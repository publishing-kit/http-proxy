<?php

declare(strict_types=1);

namespace PublishingKit\HttpProxy;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Cache\CacheItemPoolInterface;
use Http\Client\HttpClient;
use Http\Client\Common\PluginClient;
use Http\Client\Common\Plugin\CachePlugin;
use Http\Message\StreamFactory;

final class Proxy
{
    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * @var StreamFactory
     */
    private $streamFactory;

    public function __construct(HttpClient $client, CacheItemPoolInterface $cache, StreamFactory $streamFactory)
    {
        $this->client = $client;
        $this->cache = $cache;
        $this->streamFactory = $streamFactory;
    }

    public function handle(RequestInterface $request): ResponseInterface
    {
        $cachePlugin = new CachePlugin($this->cache, $this->streamFactory, []);

        $pluginClient = new PluginClient(
            $this->client,
            [$cachePlugin]
        );
        return $pluginClient->sendRequest($request);
    }
}
