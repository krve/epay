<?php

namespace Epay;

use Epay\Epay;

class TestCase extends \PHPUnit_Framework_TestCase
{
    public function __construct()
    {
        $merchant_number = getenv('EPAY_MERCHANT_NUMBER');
        $password = getenv('EPAY_PASSWORD');

        Epay::setMerchantNumber($merchant_number);
        Epay::setPassword($password);
    }
}
