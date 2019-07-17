<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 16 July 2019
 * @copyright (c) 2019, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Service\v2;

use WebMarketingROI\OptimizelyPHP\Exception;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Plan as PlanResource;

/**
 * Provides methods for working with Optimizely plans.
 */
class Plan
{
    /**
     * Optimizely API Client.
     * @var WebMarketingROI\OptimizelyPHP\OptimizelyApiClient
     */
    private $client;
    
    /**
     * Constructor.
     */
    public function __construct($client)
    {
        $this->client = $client;
    }
    
    /**
     * e information for all products, only accessible for Administrators on the account
     * @return Result
     * @throws Exception
     */
    public function get()
    {
        $result = $this->client->sendApiRequest("/plan");
        
        $plan = new PlanResource($result->getDecodedJsonData());
        $result->setPayload($plan);
        
        return $result;
    }
}

