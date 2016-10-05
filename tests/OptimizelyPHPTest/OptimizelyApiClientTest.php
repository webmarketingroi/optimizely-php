<?php
namespace OptimizelyPHPTest;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;

class OptimizelyApiClientTest extends PHPUnit_Framework_TestCase
{
    public function testCreateClient()
    {
        $apiKey = '15f57c8bc4ff4b6e148a3296cb522c6f:1fc410d3';
        $client = new OptimizelyApiClient($apiKey, 'v2');
        
        $this->assertNotNull($client);
    }    
    
    /**
     * @expectedException Exception
     */
    public function testCreateClientWrongApiKey()
    {
        $apiKey = '15f57c8bc4ff4b6e148a329fserwre6cb522c6f:1fc410d3';
        $client = new OptimizelyApiClient($apiKey);        
    }
    
    /**
     * @expectedException Exception
     */
    public function testCreateClientWrongApiVersion()
    {
        $apiKey = '15f57c8bc4ff4b6e148a3296cb522c6f:1fc410d3';
        $client = new OptimizelyApiClient($apiKey, 'v1');        
    }
    
    public function testCallService()
    {
        $apiKey = '15f57c8bc4ff4b6e148a3296cb522c6f:1fc410d3';
        $client = new OptimizelyApiClient($apiKey);        
        $experiments = $client->experiments();
        
        $this->assertNotNull($experiments);
        $this->assertTrue($experiments instanceof \WebMarketingROI\OptimizelyPHP\Service\v2\Experiments);
    }
    
    /**
     * @expectedException Exception
     */
    public function testSendHttpRequestThrowsException()
    {
        $apiKey = '15f57c8bc4ff4b6e148a3296cb522c6f:1fc410d3';
        $client = new OptimizelyApiClient($apiKey);        
        
        // API key is not a real one, so it should throw an exception
        $response = $client->sendHttpRequest('/experiments');
        print_r($response);
    }
    
    public function testGetApiVersion()
    {
        $apiKey = '15f57c8bc4ff4b6e148a3296cb522c6f:1fc410d3';
        $client = new OptimizelyApiClient($apiKey);        
        
        $apiVersion = $client->getApiVersion();
        $this->assertEquals('v2', $apiVersion);
    }
}
