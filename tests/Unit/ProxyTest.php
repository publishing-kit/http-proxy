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
}
