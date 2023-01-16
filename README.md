# Security Headers Twill Capsule

This Twill Capsule is intended to enable developers to configure Security Headers on their applications. 

![screenshot 1](docs/screenshot01.png)

![screenshot 2](docs/screenshot02.png)

## Domains

You add as many domains as you need and configure different `robots.txt` values for each. If you enable `.env` confifuration, an `all domains (*)` entry will appear, the same configuration will be used for all domains, and all other domains will be hidden.

## Installing

### Require the Composer package:

``` bash
composer require area17/twill-security-headers
```

### Publish the configuration

``` bash
php artisan vendor:publish --provider="A17\TwillSecurityHeaders\ServiceProvider"
```

### Load Capsule helpers by adding calling the loader to your AppServiceProvider:

``` php
/**
 * Register any application services.
 *
 * @return void
 */
public function register()
{
    \A17\TwillSecurityHeaders\Services\Helpers::load();
}
```

#### .env 

The configuration works both on `.env` or in the CMS settings. If you set them on `.env` the CMS settings will be disabled and overloded by `.env`. 

```dotenv
TWILL_SECURITY_HEADERS_PROTECTED=true
TWILL_SECURITY_HEADERS_RATE_LIMITING_ATTEMPTS=10
TWILL_SECURITY_HEADERS_CONTENTS_PROTECTED="User-agent: *\nDisallow: /"
TWILL_SECURITY_HEADERS_CONTENTS_UNPROTECTED="User-agent: *\nAllow: /"
```

## Contribute

Please contribute to this project by submitting pull requests.
