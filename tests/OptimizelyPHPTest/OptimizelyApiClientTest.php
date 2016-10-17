<?php
namespace OptimizelyPHPTest;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Service\v2\Experiments;

class OptimizelyApiClientTest extends PHPUnit_Framework_TestCase
{
    public function testCreateClient()
    {
        $authCredentials = array(
            'access_token' => '1234567890'
        );
        $client = new OptimizelyApiClient($authCredentials, 'v2');
        
        $this->assertNotNull($client);
    }    
    
    /**
     * @expectedException Exception
     */
    public function testCreateClientWrongCredentialFormat()
    {
        $authCredentials = '1234567';
        
        $client = new OptimizelyApiClient($authCredentials);        
    }
    
    /**
     * @expectedException Exception
     */
    public function testCreateClientWrongApiVersion()
    {
        $authCredentials = array(
            'access_token' => '1234567890'
        );
        $client = new OptimizelyApiClient($authCredentials, 'v1');        
    }
    
    public function testCallService()
    {
        $authCredentials = array(
            'access_token' => '1234567890'
        );
        $client = new OptimizelyApiClient($authCredentials);        
        
        $experiments = $client->experiments();
        
        $this->assertNotNull($experiments);
        $this->assertTrue($experiments instanceof Experiments);
    }
    
    /**
     * @expectedException Exception
     */
    public function testSendApiRequestThrowsException()
    {
        $authCredentials = array(
            'access_token' => '1234567890'
        );
        $client = new OptimizelyApiClient($authCredentials);        
        
        // Access token is not a real one, so it should throw an exception
        $response = $client->sendApiRequest('/experiments');
        print_r($response);
    }
    
    public function testGetApiVersion()
    {
        $authCredentials = array(
            'access_token' => '1234567890'
        );
        $client = new OptimizelyApiClient($authCredentials);        
        
        $apiVersion = $client->getApiVersion();
        $this->assertEquals('v2', $apiVersion);
        
        $client->setApiVersion('v2');
        $this->assertEquals('v2', $client->getApiVersion());
    }
    
    public function testSetAuthCredentials()
    {
        $authCredentials = array(
            'client_id' => '34523242342423424',
            'client_secret' => '24352342413131234636',
            'refresh_token' => '0345932524',
            'access_token' => '1234567890',            
        );
        $client = new OptimizelyApiClient($authCredentials);        
        
        $this->assertEquals($authCredentials, $client->getAuthCredentials());
        
        $authCredentials2 = array(
            'access_token' => '4252023452342134'
        );
        
        $client->setAuthCredentials($authCredentials2);
        
        $this->assertEquals($authCredentials2, $client->getAuthCredentials());        
    }
    
    public function testGetAccessToken()
    {
        $authCredentials = array(
            'access_token' => '1234567890'
        );
        $client = new OptimizelyApiClient($authCredentials);        
        
        $accessToken = $client->getAccessToken();
        $this->assertEquals('1234567890', $accessToken['access_token']);        
    }
}
