<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\SimpleTestCase;
use Mockery as m;
use PublishingKit\HttpProxy\Proxy;

final class ProxyTest extends SimpleTestCase
{
    public function testNotGet()
    {
        $request = m::spy('Psr\Http\Message\ServerRequestInterface');
        $response = m::mock('Psr\Http\Message\ResponseInterface');
        $client = m::mock('Http\Client\HttpClient');
        $client->shouldReceive('sendRequest')
            ->with($request)
            ->once()
            ->andReturn($response);
        $cache = m::mock('Psr\Cache\CacheItemPoolInterface');
        $streamFactory = m::mock('Http\Message\StreamFactory');
        $proxy = new Proxy($client, $cache, $streamFactory);
        $result = $proxy->handle($request);
        $this->assertSame($result, $response);
    }
}
