<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\SimpleTestCase;
use Mockery as m;
use PublishingKit\HttpProxy\Client;

final class ClientTest extends SimpleTestCase
{
    public function testRequest()
    {
        $request = m::mock('Psr\Http\Message\ServerRequestInterface');
        $response = m::mock('Psr\Http\Message\ResponseInterface');
        $client = new Client(function ($request) use ($response) {
            return $response;
        });
        $result = $client->sendRequest($request);
        $this->assertSame($result, $response);
    }
}
