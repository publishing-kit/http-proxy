<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\SimpleTestCase;
use Mockery as m;
use PublishingKit\HttpProxy\Proxy;

final class ProxyTest extends SimpleTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->store = m::mock('PublishingKit\HttpProxy\Contracts\StoreInterface');
        $this->proxy = new Proxy($this->store);
    }

    public function tearDown(): void
    {
        $this->store = null;
        $this->proxy = null;
        parent::tearDown();
    }

    public function testNotGet()
    {
        $request = m::mock('Psr\Http\Message\ServerRequestInterface');
        $request->shouldReceive('getMethod')
            ->once()
            ->andReturn('POST');
        $response = m::mock('Psr\Http\Message\ResponseInterface');
        $result = $this->proxy->get($request, function ($request) use ($response) {
            return $response;
        });
        $this->assertSame($result, $response);
    }

    public function testUncachedResponseReceived(): void
    {
        $request = m::mock('Psr\Http\Message\RequestInterface');
        $request->shouldReceive('getMethod')
            ->once()
            ->andReturn('GET');
        $response = m::mock('Psr\Http\Message\ResponseInterface');
        $result = $this->proxy->get($request, function ($request) use ($response) {
            return $response;
        });
        $this->assertSame($result, $response);
    }
}
