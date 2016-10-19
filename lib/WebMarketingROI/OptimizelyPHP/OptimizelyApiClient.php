<?php
/**
 * @abstract API client for Optimizely.
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 03 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP;

/**
 * Client for Optimizely REST API v2.
 */
class OptimizelyApiClient 
{
    /**
     * Auth credentials.
     * @var array
     */
    private $authCredentials = array();
    
    /**
     * API version.
     * @var string
     */
    private $apiVersion;
    
    /**
     * CURL handle.
     * @var resource 
     */
    private $curlHandle;
    
    /**
     * Instantiated services (used internally).
     * @var array
     */
    private $services = array();
    
    /**
     * Constructor.
     * @param array $authCredentials Auth credentials.
     * @param string $apiVersion Optional. Currently supported 'v2' only.
     */
    public function __construct($authCredentials, $apiVersion='v2')
    {
        if (!is_array($authCredentials)) {
            throw new \Exception('Auth credentials must be an array');            
        }
        
        if ($apiVersion!='v2') {
            throw new \Exception('Invalid API version passed');
        }
        
        $this->authCredentials = $authCredentials;
        $this->apiVersion = $apiVersion;
        
        $this->curlHandle = curl_init();
        if (!$this->curlHandle) {
            throw new \Exception('Error initializing CURL');
        }
    }
    
    /**
     * Returns API version (currently it is always 'v2').
     * @return string
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }
    
    /**
     * Sets API version. 
     * @param string $apiVersion Currently, 'v2' only.
     */
    public function setApiVersion($apiVersion)
    {
        if ($apiVersion!='v2') {
            throw new \Exception('Invalid API version passed');
        }
        
        $this->apiVersion = $apiVersion;
    }
    
    /**
     * Returns auth credentials
     * @return array
     */
    public function getAuthCredentials()
    {
        return $this->authCredentials;
    }
    
    /**
     * Sets Auth credentials.
     * @param array $authCredentials
     */
    public function setAuthCredentials($authCredentials)
    {
        if (!is_array($authCredentials) || count($authCredentials)==0) {
            throw new \Exception('Auth credentials must be an array');            
        }
        
        $this->authCredentials = $authCredentials;
    }
    
    /**
     * Returns access token information as array.
     * @return array
     */
    public function getAccessToken()
    {
        $accessToken = array();
        if (is_array($this->authCredentials)) {
            if (isset($this->authCredentials['access_token'])) {
                $accessToken['access_token'] = $this->authCredentials['access_token'];
            }
            
            if (isset($this->authCredentials['access_token_timestamp'])) {
                $accessToken['access_token_timestamp'] = $this->authCredentials['access_token_timestamp'];
            }
            
            if (isset($this->authCredentials['token_type'])) {
                $accessToken['token_type'] = $this->authCredentials['token_type'];
            }
            
            if (isset($this->authCredentials['expires_in'])) {
                $accessToken['expires_in'] = $this->authCredentials['expires_in'];
            }
        }
        
        return $accessToken;
    }
    
    /**
     * Returns refresh token.
     * @return string
     */
    public function getRefreshToken()
    {
        if (is_array($this->authCredentials)) {
            if (isset($this->authCredentials['refresh_token'])) {
                return $this->authCredentials['refresh_token'];
            }
        }
        
        return null;
    }
    
    /**
     * Sends an HTTP request to the given URL and returns response in form of array. 
     * @param string $url The URL of Optimizely endpoint (relative, without host and API version).
     * @param array $queryParams The list of query parameters.
     * @param string $method HTTP method (GET or POST).
     * @param array $postData Data send in request body (only for POST method).
     * @param array $expectedResponseCodes List of HTTP response codes treated as success.
     * @return array Optimizely response in form of array.
     * @throws \Exception
     */
    public function sendApiRequest($url, $queryParams = array(), $method='GET', 
            $postData = array(), $expectedResponseCodes = array(200))
    {
        // If access token has expired, try to get another one with refresh token.
        if ($this->isAccessTokenExpired() && $this->getRefreshToken()!=null) {
            $this->getAccessTokenByRefreshToken();
        }
        
        // Produce absolute URL
        $url = 'https://api.optimizely.com/' . $this->apiVersion . $url;
        
        $result = $this->sendHttpRequest($url, $queryParams, $method, 
                $postData, $expectedResponseCodes);
        
        return $result;
    }
    
    /**
     * Sends an HTTP request to the given URL and returns response in form of array. 
     * @param string $url The URL of Optimizely endpoint.
     * @param array $queryParams The list of query parameters.
     * @param string $method HTTP method (GET or POST).
     * @param array $postData Data send in request body (only for POST method).
     * @param array $expectedResponseCodes List of HTTP response codes treated as success.
     * @return array Optimizely response in form of array.
     * @throws \Exception
     */
    private function sendHttpRequest($url, $queryParams = array(), $method='GET', 
            $postData = array(), $expectedResponseCodes = array(200))
    {
        // Check if CURL is initialized (it should have been initialized in 
        // constructor).
        if ($this->curlHandle==false) {
            throw new \Exception('CURL is not initialized', -1);
        }
        
        if ($method!='GET' && $method!='POST' && $method!='PUT' && 
            $method!='PATCH' && $method!='DELETE') {
            throw new \Exception('Invalid HTTP method passed: ' . $method, -1);
        }
        
        if (!isset($this->authCredentials['access_token'])) {
            throw new \Exception('OAuth access token is not set. You should pass ' . 
                    'it to the class constructor when initializing the Optimizely client.', -1);
        }
                
        // Append query parameters to URL.
        if (count($queryParams)!=0) {            
            $query = http_build_query($queryParams);
            $url .= '?' . $query;
        }
        
        $headers = array(
            "Authorization: Bearer " . $this->authCredentials['access_token'],
            "Content-Type: application/json"
            );
        $content = '';
        if (count($postData)!=0) {
            $content = json_encode($postData);            
        }
        $headers[] = "Content-length:" . strlen($content);            
        
        // Set HTTP options.
        curl_setopt($this->curlHandle, CURLOPT_URL, $url);
        curl_setopt($this->curlHandle, CURLOPT_CUSTOMREQUEST, $method);        
        if (count($postData)!=0) {
            curl_setopt($this->curlHandle, CURLOPT_POSTFIELDS, $content);            
        }
        curl_setopt($this->curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curlHandle, CURLOPT_HEADER, false);        
        curl_setopt($this->curlHandle, CURLOPT_HTTPHEADER, $headers);
        
        // Execute HTTP request and get response.
        $result = curl_exec($this->curlHandle);
        if ($result === false) {
            $code = curl_errno($this->curlHandle);
            $error = curl_error($this->curlHandle);
            throw new \Exception("Failed to send HTTP request $method '$url', the error code was $code, error message was: '$error'", -1);
        }        
        
        // Check HTTP response code.
        $info = curl_getinfo($this->curlHandle);
        if (!in_array($info['http_code'], $expectedResponseCodes)) {
            throw new \Exception('Unexpected HTTP response code: ' . $info['http_code'] . 
                    '. Request was ' . $method . ' "' . $url . '". Response was "' . $result . '"',
                    $info['http_code']);
        }
        
        // JSON-decode response.
        $decodedResult = json_decode($result, true);
        if (!is_array($decodedResult)) {
            throw new \Exception('Could not JSON-decode the Optimizely response. Request was ' . 
                    $method . ' "' . $url . '". The response was: "' . $result . '"',
                    $info['http_code']);
        }
        
        // Return the response in form of array.
        return $decodedResult;
    }
    
    /**
     * Determines whether the access token has expired or not. Returns true if 
     * token has expired; false if token is valid.
     * @return boolean
     */
    private function isAccessTokenExpired() 
    {
        if(!isset($this->authCredentials['access_token'])) {
            return true; // We do not have access token.
        }
        
        if (!isset($this->authCredentials['expires_in']) || 
            !isset($this->authCredentials['access_token_timestamp'])) {
            return true; // Assume it has expired, since we can't tell for sure.
        } 
        
        $expiresIn = $this->authCredentials['expires_in'];
        $timestamp = $this->authCredentials['access_token_timestamp'];
        
        if ($timestamp + $expiresIn < time()) {
            // Access token has expired.
            return true;
        }
        
        // Access token is valid.
        return false;
    }
    
    /**
     * This method retrieves the access token by refresh token.
     * @return array
     */
    private function getAccessTokenByRefreshToken()
    {
        if (!isset($this->authCredentials['client_id']))
            throw new \Exception('OAuth 2.0 client ID is not set');
        
        if (!isset($this->authCredentials['client_secret']))
            throw new \Exception('OAuth 2.0 client secret is not set');
        
        if (!isset($this->authCredentials['refresh_token']))
            throw new \Exception('Refresh token is not set');
        
        $clientId = $this->authCredentials['client_id'];
        $clientSecret = $this->authCredentials['client_secret'];
        $refreshToken = $this->authCredentials['refresh_token'];
        
        $url = "https://app.optimizely.com/oauth2/token?refresh_token=$refreshToken&client_id=$clientId&client_secret=$clientSecret&grant_type=refresh_token";
        
        $response = $this->sendHttpRequest($url, array(), 'POST');
        
        if (!isset($response['access_token'])) {
            throw new \Exception('Not found access token in response. Request URL was "' . $url. '". Response was "' . print_r($response, true). '"');
        }
        
        $this->authCredentials['access_token'] = $response['access_token'];
        $this->authCredentials['token_type'] = $response['token_type'];
        $this->authCredentials['expires_in'] = $response['expires_in'];
        $this->authCredentials['access_token_timestamp'] = time(); 
    }
    
    /**
     * Provides access to API services (experiments, campaigns, etc.)
     * @method Audiences audiences()
     * @method Campaigns campaigns()
     * @method Events events()
     * @method Experiment experiments()
     * @method Pages pages()
     * @method Projects projects()
     */
    public function __call($name, $arguments)
    {
        $allowedServiceNames = array(
            'audiences',
            'campaigns',
            'events',
            'experiments',
            'pages',
            'projects'
        );
        
        // Check if the service name is valid
        if (!in_array($name, $allowedServiceNames)) {
            throw new \Exception("Unexpected service name: $name");
        }
        
        // Check if such service already instantiated
        if (isset($this->services[$this->apiVersion][$name])) {
            $service = $this->services[$this->apiVersion][$name];
        } else {
            // Instantiate the service
            $apiVersion = $this->apiVersion;
            $serviceName = ucwords($name);
            $className = "\\WebMarketingROI\\OptimizelyPHP\\Service\\$apiVersion\\$serviceName";
            $service = new $className($this); 
            $this->services[$apiVersion][$name] = $service;
        }

        return $service;
    }
}