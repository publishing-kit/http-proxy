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

    public function testUncachedResponseReceived(): void
    {
        $request = m::mock('Psr\Http\Message\RequestInterface');
        $request->shouldReceive('hasHeader')->with('Cache-Control')->once()->andReturn(false);
        $request->shouldReceive('hasHeader')->with('Expires')->once()->andReturn(false);
        $request->shouldReceive('hasHeader')->with('ETag')->once()->andReturn(false);
        $request->shouldReceive('hasHeader')->with('Last-Modified')->once()->andReturn(false);
        $response = m::mock('Psr\Http\Message\ResponseInterface');
        $this->proxy->get($request, function ($request) use ($response) {
            return $response;
        });
    }
}
