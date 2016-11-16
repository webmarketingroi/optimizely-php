<?php
namespace OptimizelyPHPTest;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\Result;

class ResultTest extends PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $data = array(
            "name" => "Test Project",
            "account_id" => 12345,
            "confidence_threshold" => 0.9,
            "dcp_service_id" => 121234,
            "platform" => "web",
            "status" => "active",
            "web_snippet" => array(
              "enable_force_variation" => false,
              "exclude_disabled_experiments" => false,
              "exclude_names" => true,
              "include_jquery" => true,
              "ip_anonymization" => false,
              "ip_filter" => "^206\\.23\\.100\\.([5-9][0-9]|1([0-4][0-9]|50))$",
              "library" => "jquery-1.11.3-trim",
              "project_javascript" => "alert(\"Active Experiment\")"
            ));
        
        $result = new Result($data, 200);
        $result->setPayload(1);
        $result->setPrevPage(2);
        $result->setNextPage(3);
        $result->setLastPage(5);
        $result->setRateLimit(100);
        $result->setRateLimitRemaining(98);
        $result->setRateLimitReset(123456789);
        
        $this->assertEquals($data, $result->getDecodedJsonData());
        $this->assertEquals(200, $result->getHttpCode());
        $this->assertEquals(1, $result->getPayload());
        $this->assertEquals(2, $result->getPrevPage());
        $this->assertEquals(3, $result->getNextPage());
        $this->assertEquals(5, $result->getLastPage());
        $this->assertEquals(100, $result->getRateLimit());
        $this->assertEquals(98, $result->getRateLimitRemaining());
        $this->assertEquals(123456789, $result->getRateLimitReset());
    }    
}
