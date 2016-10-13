<?php
namespace OptimizelyPHPTest\Service\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;

class ExperimentsTest extends PHPUnit_Framework_TestCase
{
    public function testListAll()
    {
        $apiKey = getenv('OPTIMIZELY_PHP_API_KEY');
        $client = new OptimizelyApiClient($apiKey);
        
        $experiments = $client->experiments()->listAll();
        
        $this->assertTrue(count($experiments)!=0);
        foreach ($experiments as $experiment) {
            $this->assertTrue($experiment instanceOf \WebMarketingROI\OptimizelyPHP\Resource\v2\Experiment);
            $this->assertTrue(strlen($experiment->getName())!=0);
        }
    }
}
