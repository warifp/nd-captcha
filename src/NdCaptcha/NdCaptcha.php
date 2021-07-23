<?php

namespace NdCaptcha;

use Curl\Curl;

$curl = new Curl();

Class NdCaptcha
{
    protected $curl;

    public function __construct($key, $pageUrl, $googleKey) {
        $this->curl = new Curl();
        $this->key = $key;
        $this->pageUrl = $pageUrl;
        $this->googleKey = $googleKey;
    }

    public function init() {
        $this->curl->get('https://2captcha.com/in.php?key=' . $this->key . '&method=userrecaptcha&googlekey=' . $this->googleKey . '&pageurl=' . $this->pageUrl);

        if ($this->curl->error) {
            echo 'Error: ' . $this->curl->errorCode . ': ' . $this->curl->errorMessage . "\n";
        } else {
            $inResponse = explode("|", $this->curl->response);
            
            if ($inResponse[0] == 'OK') {
                start:
                $this->curl->get('http://2captcha.com/res.php?key=' . $this->key . '&action=get&id=' . $inResponse[1]);

                if ($this->curl->error) {
                    echo 'Error: ' . $this->curl->errorCode . ': ' . $this->curl->errorMessage . "\n";
                } else {
                    $resResponse = explode("|", $this->curl->response);

                    if($resResponse[0] == 'OK') {
                        $data = [
                            'status' => true,
                            'captcha' => $resResponse[1],
                        ];
                    } else if($resResponse[0] == 'ERROR_WRONG_USER_KEY') {
                        $data = [
                            'status' => false,
                            'captcha' => $resResponse[0],
                        ];
                    } else if($resResponse[0] == 'ERROR_WRONG_CAPTCHA_ID') {
                        $data = [
                            'status' => false,
                            'captcha' => $resResponse[0],
                        ];
                    } else{
                        goto start;
                    }

                    return $data;
                }
            } else{
                $data = [
                    'status' => false,
                    'errors' => [
                        'path' => 'in',
                        'message' => $this->curl->response,
                    ],
                ];
            }

            return $data;
        }
    }
}