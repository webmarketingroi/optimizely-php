<?php
/**
 * @abstract API client for Optimizely.
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 14 November 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP;

/**
 * Contains parsed response from Optimizely API.
 */
class Result
{
    /**
     * HTTP code.
     * @var integer
     */
    private $httpCode;
    
    /**
     * Payload.
     * @var mixed
     */
    private $payload = null;
    
    /**
     * Previous page number (or null).
     * @var integer|null
     */
    private $prevPage = null;
    
    /**
     * Next page number (or null).
     * @var integer|null
     */
    private $nextPage = null;
    
    /**
     * Last page number
     * @var integer|null
     */
    private $lastPage = null;
    
    /**
     * The limit for this endpoint
     * @var integer
     */
    private $rateLimit;
    
    /**
     * The amount of calls remaining for this endpoint
     * @var integer
     */
    private $rateLimitRemaining;
    
    /**
     * The X-RateLimit-Reset header provides a Unix UTC timestamp, letting you 
     * know the exact time that your fresh new rate limit kicks in.
     * @var string
     */
    private $rateLimitReset;
    
    /**
     * Decoded JSON response data.
     * @var array
     */
    private $decodedJsonData = null;
    
    /**
     * Constructor.
     * @param array $decodedJsonData
     * @param string $rawHttpResponseData
     * @param array[string] $rawHttpResponseHeaders
     */
    public function __construct($decodedJsonData, $httpCode)
    {
        $this->decodedJsonData = $decodedJsonData;
        $this->httpCode = $httpCode;
    }
    
    /**
     * Return HTTP response code.
     * @return integer
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }
            
    /**
     * Set HTTP response code.
     * @param integer $code
     */
    public function setHttpCode($httpCode)
    {
        $this->httpCode = $httpCode;
    }
    
    /**
     * Return payload.
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }
    
    /**
     * Set payload (parsed and wrapped response data).
     * @param mixed $payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }
    
    /**
     * Return decoded JSON data.
     * @return array
     */
    public function getDecodedJsonData()
    {
        return $this->decodedJsonData;
    }
    
    /**
     * Set decoded JSON data.
     * @param array $decodedJsonData
     */
    public function setDecodedJsonData($decodedJsonData)
    {
        $this->decodedJsonData = $decodedJsonData;
    }
    
    /**
     * Returns previous page number (or null).
     * @return integer|null
     */
    public function getPrevPage()
    {
        return $this->prevPage;
    }
    
    /**
     * Set previous page number.
     * @param integer|null $prevPage
     */
    public function setPrevPage($prevPage)
    {
        $this->prevPage = $prevPage;
    }
    
    /**
     * Returns next page number (or null).
     * @return integer|null
     */
    public function getNextPage()
    {
        return $this->nextPage;
    }
    
    /**
     * Set next page number.
     * @param integer|null $nextPage
     */
    public function setNextPage($nextPage)
    {
        $this->nextPage = $nextPage;
    }
    
    /**
     * Return last page number
     * @return integer|null
     */
    public function getLastPage()
    {
        return $this->lastPage;
    }
    
    /**
     * Set last page number.
     * @param integer|null $lastPage
     */
    public function setLastPage($lastPage)
    {
        $this->lastPage = $lastPage;
    }
    
    public function getRateLimit()
    {
        return $this->rateLimit;
    }
    
    public function setRateLimit($rateLimit)
    {
        $this->rateLimit = $rateLimit;
    }
    
    public function getRateLimitRemaining()
    {
        return $this->rateLimitRemaining;
    }
    
    public function setRateLimitRemaining($rateLimitRemaining)
    {
        $this->rateLimitRemaining = $rateLimitRemaining;
    }
    
    public function getRateLimitReset()
    {
        return $this->rateLimitReset;
    }
    
    public function setRateLimitReset($rateLimitReset)
    {
        $this->rateLimitReset = $rateLimitReset;
    }
}


