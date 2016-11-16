<?php
namespace OptimizelyPHPTest;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Service\v2\Experiments;
use WebMarketingROI\OptimizelyPHP\Exception;

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
     * @expectedException WebMarketingROI\OptimizelyPHP\Exception
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
    
    /**
     * @expectedException Exception
     */
    public function testSetApiVersion_WrongVer()
    {
        $authCredentials = array(
            'access_token' => '1234567890'
        );
        $client = new OptimizelyApiClient($authCredentials);        
        
        $client->setApiVersion('v1');        
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
    
    /**
     * @expectedException Exception
     */
    public function testSetAuthCredentials_InvalidArg()
    {
        $client = new OptimizelyApiClient(1234);        
    }
    
    /**
     * @expectedException Exception
     */
    public function testSetAuthCredentials_EmptyArray()
    {
        $client = new OptimizelyApiClient(array());        
    }
    
    public function testGetAccessToken()
    {
        $authCredentials = array(
            'access_token' => '1234567890',
            'access_token_timestamp' => time(),
            'expires_in' => 7200,
            'token_type' => 'bearer'
        );
        $client = new OptimizelyApiClient($authCredentials);        
        
        $accessToken = $client->getAccessToken();
        $this->assertEquals('1234567890', $accessToken['access_token']);
        $this->assertEquals('bearer', $accessToken['token_type']);
    }
    
    public function testGetAccessTokenByRefreshToken()
    {
        $authCredentials = array(
            'client_id' => '23423423423424242423424',
            'client_secret' => '2323424234242424234',
            'refresh_token' => '24242424244523452gf234',
            'access_token' => '1234567890234234234234',
            'access_token_timestamp' => time() - 8000,
            'expires_in' => 7200,
            'token_type' => 'bearer'
        );
        $client = new OptimizelyApiClient($authCredentials);        
        
        // Issuing sendApiRequest() method will try to get access token with 
        // refresh token, since the provided access token is invalid.
        try {
            $result = $client->sendApiRequest('/projects');        
        }
        catch (Exception $e) {
            $this->assertEquals(Exception::CODE_API_ERROR, $e->getCode());
            $this->assertEquals(400, $e->getHttpCode());            
        }
    }
    
    public function testGetDiagnosticsInfo()
    {
        $authCredentials = array(
            'access_token' => '1234567890'
        );
        $client = new OptimizelyApiClient($authCredentials);        
        
        $diagInfo = $client->getDiagnosticsInfo();
        $this->assertTrue(is_array($diagInfo));
    }
}
