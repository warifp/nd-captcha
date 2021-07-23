<?php
require __DIR__ . '/vendor/autoload.php';

use NdCaptcha\NdCaptcha;

$recaptcha = new NdCaptcha(
    '2CAPTCHA_KEY',
    'PAGE_URL',
    'GOOGLE_KEY',
);

$captcha = $recaptcha->init();
var_dump($captcha);