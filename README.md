# NdCaptcha: 2Captcha

[![](https://img.shields.io/github/release/warifp/nd-captcha.svg?style=flat-square&sort=semver)](https://github.com/warifp/nd-captcha/releases/)
[![](https://img.shields.io/packagist/dt/warifp/nd-captcha.svg?style=flat-square)](https://github.com/warifp/nd-captcha/releases/)

API module integration from [2Captcha](https://2captcha.com).

### Installation

To install Nd Captcha, simply:

    $ composer require warifp/nd-captcha

For latest commit version:

    $ composer require warifp/nd-captcha @dev

### Requirements

PHP Nd Captcha works with PHP 7.0, 7.1, 7.2, 7.3, 7.4, and 8.0.

### Quick Start and Examples

More examples are available under [/examples](https://github.com/warifp/nd-captcha/tree/master/examples).

```php
require __DIR__ . '/vendor/autoload.php';

use NdCaptcha\NdCaptcha;

$recaptcha = new NdCaptcha(
    '2CAPTCHA_KEY',
    'PAGE_URL',
    'GOOGLE_KEY',
);

$captcha = $recaptcha->init();
var_dump($captcha);
```
