<?php

declare(strict_types=1);

namespace PublishingKit\HttpProxy\Proxy;

use PublishingKit\HttpProxy\Contracts\StoreInterface;

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
}
