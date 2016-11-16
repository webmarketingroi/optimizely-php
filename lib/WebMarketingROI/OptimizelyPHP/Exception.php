<?php
/**
 * @abstract API client for Optimizely.
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 14 November 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP;

/**
 * Contains error/exception information returned by Optimizely API.
 */
class Exception extends \Exception
{
    // Error codes returned as part of exception information.
    const CODE_INVALID_ARG       = -1; // Invalid argument passed.
    const CODE_CURL_ERROR        = -2; // Some error in CURL.
    const CODE_API_ERROR         = -3; // Some error condition returned by Optimizely API.
    
    /**
     * HTTP response code.
     * @var integer
     */
    private $httpCode;
    
    /**
     * Error UUID extracted from response JSON.
     * @var type 
     */
    private $uuid;
    
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
     * Constructor.
     */
    public function __construct($message, $code = self::CODE_INVALID_ARG, $options = array())
    {
        parent::__construct($message, $code);
        
        if (isset($options['http_code']))
            $this->setHttpCode($options['http_code']);
                
        if (isset($options['uuid']))
            $this->setUuid($options['uuid']);
        
        if (isset($options['rate_limit']))
            $this->setRateLimit($options['rate_limit']);
        
        if (isset($options['rate_limit_remaining']))
            $this->setRateLimitRemaining($options['rate_limit_remaining']);
        
        if (isset($options['rate_limit_reset']))
            $this->setRateLimitReset($options['rate_limit_reset']);
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
     * Return error UUID.
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }
            
    /**
     * Set message
     * @param string $message
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }    
    
    /**
     * Return rate limit.
     * @return integer|null
     */
    public function getRateLimit()
    {
        return $this->rateLimit;
    }
    
    /**
     * Set rate limit.
     * @param integer|null $rateLimit
     */
    public function setRateLimit($rateLimit)
    {
        $this->rateLimit = $rateLimit;
    }
    
    /**
     * Return the amount of calls remaining.
     * @return integer|null
     */
    public function getRateLimitRemaining()
    {
        return $this->rateLimitRemaining;
    }
    
    /**
     * Set the amount of calls remaining.
     * @param integer|null $rateLimitRemaining
     */
    public function setRateLimitRemaining($rateLimitRemaining)
    {
        $this->rateLimitRemaining = $rateLimitRemaining;
    }
    
    /**
     * Return the exact time that your fresh new rate limit kicks in.
     * @return integer|null
     */
    public function getRateLimitReset()
    {
        return $this->rateLimitReset;
    }
    
    /**
     * Set the exact time that your fresh new rate limit kicks in.
     * @param integer|null $rateLimitReset
     */
    public function setRateLimitReset($rateLimitReset)
    {
        $this->rateLimitReset = $rateLimitReset;
    }
}


