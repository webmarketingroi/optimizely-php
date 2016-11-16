<?php
namespace OptimizelyPHPTest;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\Exception;

class ExceptionTest extends PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $exception = new Exception('Error', -2, array(
            'http_code' => 400,
            'uuid' => '232342342342424',
            'rate_limit' => 100,
            'rate_limit_remaining' => 98,
            'rate_limit_reset' => 123456789
        ));
        
        $this->assertEquals(-2, $exception->getCode());
        $this->assertEquals(400, $exception->getHttpCode());
        $this->assertEquals('232342342342424', $exception->getUuid());
        $this->assertEquals(100, $exception->getRateLimit());
        $this->assertEquals(98, $exception->getRateLimitRemaining());
        $this->assertEquals(123456789, $exception->getRateLimitReset());
    }    
}


