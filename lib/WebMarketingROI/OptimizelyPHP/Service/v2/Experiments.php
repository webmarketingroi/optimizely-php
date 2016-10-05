<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 03 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Service\v2;

/**
 * Provides methods for working with Optimizely experiments.
 */
class Experiments 
{
    /**
     * Optimizely API Client.
     * @var WebMarketingROI\OptimizelyPHP\Client
     */
    private $client;
    
    /**
     * Constructor.
     */
    public function __construct($client)
    {
        $this->client = $client;
    }
    
    public function listAll()
    {
        $response = $client->sendHttpRequest('/experiments');
        
    }
    
    public function get($experimentId)
    {
        if (!is_int($experimentId)) {
            throw new \Exception("Integer experiment ID expected, while got '$experimentId'");
        }
        
        $response = $client->sendHttpRequest("/experiments/$experimentId");
    }
}

