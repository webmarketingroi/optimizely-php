<?php
/**
 * @abstract API client for Optimizely.
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 03 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP;

use WebMarketingROI\OptimizelyPHP\Exception;
use WebMarketingROI\OptimizelyPHP\Result;

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
     * Debugging information. Typically contains the last HTTP request/response.
     * @var type 
     */
    private $diagnosticsInfo = array();
    
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
            throw new Exception('Auth credentials must be an array');            
        }
        
        if ($apiVersion!='v2') {
            throw new Exception('Invalid API version passed');
        }
        
        $this->setAuthCredentials($authCredentials);
        $this->setApiVersion($apiVersion);
        
        $this->curlHandle = curl_init();
        if (!$this->curlHandle) {
            throw new Exception('Error initializing CURL',
                    Exception::CODE_CURL_ERROR);
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
            throw new Exception('Invalid API version passed');
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
            throw new Exception('Auth credentials must be an non-empty array');            
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
     * @return array Optimizely response in form of array.
     * @throws Exception
     */
    public function sendApiRequest($url, $queryParams = array(), $method='GET', 
            $postData = array())
    {
        // If access token has expired, try to get another one with refresh token.
        if ($this->isAccessTokenExpired() && $this->getRefreshToken()!=null) {
            $this->getAccessTokenByRefreshToken();
        }
        
        // Produce absolute URL
        $url = 'https://api.optimizely.com/' . $this->apiVersion . $url;
        
        $result = $this->sendHttpRequest($url, $queryParams, $method, $postData);
        
        return $result;
    }
    
    /**
     * Sends an HTTP request to the given URL and returns response in form of array. 
     * @param string $url The URL of Optimizely endpoint.
     * @param array $queryParams The list of query parameters.
     * @param string $method HTTP method (GET or POST).
     * @param array $postData Data send in request body (only for POST method).
     * @return array Optimizely response in form of array.
     * @throws Exception
     */
    private function sendHttpRequest($url, $queryParams = array(), $method='GET', 
            $postData = array())
    {
        // Reset diagnostics info.
        $this->diagnosticsInfo = array();
        
        // Check if CURL is initialized (it should have been initialized in 
        // constructor).
        if ($this->curlHandle==false) {
            throw new Exception('CURL is not initialized', 
                    Exception::CODE_CURL_ERROR);
        }
        
        if ($method!='GET' && $method!='POST' && $method!='PUT' && 
            $method!='PATCH' && $method!='DELETE') {
            throw new Exception('Invalid HTTP method passed: ' . $method);
        }
        
        if (!isset($this->authCredentials['access_token'])) {
            throw new Exception('OAuth access token is not set. You should pass ' . 
                    'it to the class constructor when initializing the Optimizely client.');
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
        
        // Reset CURL state.
        if (!function_exists('curl_reset')) {
            curl_close($this->curlHandle);
            $this->curlHandle = curl_init(); 
        } else {
            curl_reset($this->curlHandle);
        }
        
        // Set HTTP options.
        curl_setopt($this->curlHandle, CURLOPT_URL, $url);
        curl_setopt($this->curlHandle, CURLOPT_CUSTOMREQUEST, $method);        
        if (count($postData)!=0) {
            curl_setopt($this->curlHandle, CURLOPT_POSTFIELDS, $content);            
        }
        curl_setopt($this->curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curlHandle, CURLOPT_HEADER, true);        
        curl_setopt($this->curlHandle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($this->curlHandle, CURLINFO_HEADER_OUT, true);
        
        // Save diagnostics info.
        $this->diagnosticsInfo['request']['method'] = $method;
        $this->diagnosticsInfo['request']['url'] = $url;
        $this->diagnosticsInfo['request']['headers'] = $headers;
        $this->diagnosticsInfo['request']['content'] = $content;        
        
        // Execute HTTP request and get response.
        $result = curl_exec($this->curlHandle);                        
        if ($result === false) {
            $code = curl_errno($this->curlHandle);
            $error = curl_error($this->curlHandle);
            throw new Exception("Failed to send HTTP request $method '$url', " . 
                    "the error code was $code, error message was: '$error'", 
                    Exception::CODE_CURL_ERROR, $code, $error);
        }        
        
        // Split response headers and body
        $headerSize = curl_getinfo($this->curlHandle, CURLINFO_HEADER_SIZE);
        $headers = substr($result, 0, $headerSize);
        $body = substr($result, $headerSize);

        // Parse response headers.
        $headers = explode("\n", $headers);
        $parsedHeaders = array();
        foreach ($headers as $i=>$header) {
            if ($i==0)
                continue; // Skip first line (http code).
            $pos = strpos($header, ':');
            if ($pos!=false) {
                $headerName = trim(strtolower(substr($header, 0, $pos)));
                $headerValue = trim(substr($header, $pos+1));
                $parsedHeaders[$headerName] = $headerValue;
            }
        }
        
        // Get HTTP code.
        $info = curl_getinfo($this->curlHandle);    
        $httpCode = $info['http_code'];
        
        // Save diagnostics info.
        $this->diagnosticsInfo['response']['http_code'] = $httpCode;
        $this->diagnosticsInfo['response']['headers'] = $headers;
        $this->diagnosticsInfo['response']['content'] = $body;                       
        
        // Determine if we have rate limiting headers
        $rateLimit = null;
        $rateLimitRemaining = null;
        $rateLimitReset = null;
        if (isset($parsedHeaders['x-ratelimit-limit'])) {
            $rateLimit = $parsedHeaders['x-ratelimit-limit'];
        }
        
        if (isset($parsedHeaders['x-ratelimit-remaining'])) {
            $rateLimitRemaining = $parsedHeaders['x-ratelimit-remaining'];
        }
        
        if (isset($parsedHeaders['x-ratelimit-reset'])) {
            $rateLimitReset = $parsedHeaders['x-ratelimit-reset'];
        }        
        
        // JSON-decode payload.
        $decodedPayload = json_decode($body, true);
        if ($decodedPayload===false) {
            throw new Exception('Could not JSON-decode the Optimizely API response. Request was ' . 
                    $method . ' "' . $url . '". The response was: "' . $body . '"',
                    Exception::CODE_API_ERROR, array('http_code'=>$httpCode));
        }
        
        // Check HTTP response code.
        if ($httpCode<200 || $httpCode>299) {
            
            if (!isset($decodedPayload['message']) || 
                !isset($decodedPayload['code']) ||
                !isset($decodedPayload['uuid'])) {
                throw new Exception('Optimizely API responded with error code ' . $httpCode . 
                    '. Request was ' . $method . ' "' . $url . '". Response was "' . $body . '"',
                    Exception::CODE_API_ERROR, array(
                        'http_code' => $httpCode,
                        'rate_limit' => $rateLimit,
                        'rate_limit_remaining' => $rateLimitRemaining,
                        'rate_limit_reset' => $rateLimitReset,
                    ));
            }
            
            print_r($this->getDiagnosticsInfo());
            
            throw new Exception($decodedPayload['message'], Exception::CODE_API_ERROR, 
                    array(
                        'http_code'=>$decodedPayload['code'], 
                        'uuid'=>$decodedPayload['uuid'],
                        'rate_limit' => $rateLimit,
                        'rate_limit_remaining' => $rateLimitRemaining,
                        'rate_limit_reset' => $rateLimitReset
                    ));
        }        
        
        // Create Result object
        $result = new Result($decodedPayload, $httpCode);
        $result->setRateLimit($rateLimit);
        $result->setRateLimitRemaining($rateLimitRemaining);
        $result->setRateLimitReset($rateLimitReset);
        
        // Determine if we have prev/next/last page headers.
        if (isset($parsedHeaders['link']))
        {
            // Parse LINK header
            $matched = preg_match_all('/<(.+)>;\s+rel=(\w+)(,|\z)/U', 
                    $parsedHeaders['link'], $matches, PREG_SET_ORDER);
            if (!$matched) {
                throw new Exception('Error parsing LINK header: ' . 
                        $parsedHeaders['link'], Exception::CODE_API_ERROR, $httpCode);
            }
            
            foreach ($matches as $match) {
                
                $url = $match[1];
                $rel = $match[2];
                
                $matched = preg_match('/page=(\d+)/U', $url, $pageMatches);
                if (!$matched || count($pageMatches)!=2) {
                    throw new Exception('Error extracting page argument while parsing LINK header: ' . 
                            $parsedHeaders['link'], Exception::CODE_API_ERROR, 
                            array('http_code'=>$httpCode));
                }
                
                $pageNumber = $pageMatches[1];
                
                if ($rel=='prev') {
                    $result->setPrevPage($pageNumber);
                } else if ($rel=='next') {
                    $result->setNextPage($pageNumber);
                } else if ($rel=='last') {
                    $result->setLastPage($pageNumber);
                } else {
                    throw new Exception('Unexpected rel argument while parsing LINK header: ' . 
                            $parsedHeaders['link'], Exception::CODE_API_ERROR, 
                            array('http_code'=>$httpCode));
                }
            }
        }        
                
        // Return the result.
        return $result;
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
     * @throw Exception
     */
    private function getAccessTokenByRefreshToken()
    {
        if (!isset($this->authCredentials['client_id']))
            throw new Exception('OAuth 2.0 client ID is not set');
        
        if (!isset($this->authCredentials['client_secret']))
            throw new Exception('OAuth 2.0 client secret is not set');
        
        if (!isset($this->authCredentials['refresh_token']))
            throw new Exception('Refresh token is not set');
        
        $clientId = $this->authCredentials['client_id'];
        $clientSecret = $this->authCredentials['client_secret'];
        $refreshToken = $this->authCredentials['refresh_token'];
        
        $url = "https://app.optimizely.com/oauth2/token?refresh_token=$refreshToken" . 
                "&client_id=$clientId&client_secret=$clientSecret&grant_type=refresh_token";
        
        $response = $this->sendHttpRequest($url, array(), 'POST');
        $decodedJsonData = $response->getDecodedJsonData();
        
        if (!isset($decodedJsonData['access_token'])) {
            throw new Exception('Not found access token in response. Request URL was "' . 
                    $url. '". Response was "' . print_r(json_encode($decodedJsonData), true). '"',
                    Exception::CODE_API_ERROR, $response->getHttpCode());
        }
        
        $this->authCredentials['access_token'] = $decodedJsonData['access_token'];
        $this->authCredentials['token_type'] = $decodedJsonData['token_type'];
        $this->authCredentials['expires_in'] = $decodedJsonData['expires_in'];
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
            'projects',
            'attributes'
        );
        
        // Check if the service name is valid
        if (!in_array($name, $allowedServiceNames)) {
            throw new Exception("Unexpected service name: $name");
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
    
    /**
     * Returns last HTTP request/response information (for diagnostics/debugging
     * purposes):
     *   - request
     *     - method
     *     - headers
     *     - content
     *   - response
     *     - http_code
     *     - headers
     *     - content
     * @return array
     */
    public function getDiagnosticsInfo()
    {
        return $this->diagnosticsInfo;
    }
}