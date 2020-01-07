# http-proxy

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

PublishingKit/http-proxy is a simple reverse caching HTTP proxy. Rather than doing any actual caching itself, it's instead implemented as a very simple HTTPlug client, which is wrapped in the HTTPlug caching plugin.

## Install

Via Composer

``` bash
$ composer require publishing-kit/http-proxy
```

## Usage

Assuming the following:

* `$app` is a callable (can be a function, or a class with the `__invoke()` magic method defined) that accepts a PSR7 request object as its sole argument
* `$cache` is an instance of `Psr\Cache\CacheItemPoolInterface`
* `$streamFactory` is an HTTPlug stream factory implementation

``` php
$app = new App();
$client = new PublishingKit\HttpProxy\Client($app);
$proxy = new PublishingKit\HttpProxy\Proxy($client, $cache, $streamFactory);
$response = $proxy->handle($request);
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email 450801+matthewbdaly@users.noreply.github.com instead of using the issue tracker.

## Credits

- [Matthew Daly][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/publishing-kit/http-proxy.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/publishing-kit/http-proxy/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/publishing-kit/http-proxy.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/publishing-kit/http-proxy.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/publishing-kit/http-proxy.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/publishing-kit/http-proxy
[link-travis]: https://travis-ci.org/publishing-kit/http-proxy
[link-scrutinizer]: https://scrutinizer-ci.com/g/publishing-kit/http-proxy/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/publishing-kit/http-proxy
[link-downloads]: https://packagist.org/packages/publishing-kit/http-proxy
[link-author]: https://github.com/matthewbdaly
[link-contributors]: ../../contributors
