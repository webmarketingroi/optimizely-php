<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 07 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Service\v2;

use WebMarketingROI\OptimizelyPHP\Resource\v2\Audience;

/**
 * Provides methods for working with Optimizely audiences.
 */
class Audiences
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
     * List Audiences for a Project
     * @param integer $projectId
     * @param integer $page
     * @param integer $perPage
     * @return array[Audience]
     * @throws \Exception
     */
    public function listAll($projectId, $page=0, $perPage=10)
    {
        if ($page<0) {
            throw new \Exception('Invalid page number passed');
        }
        
        if ($perPage<0) {
            throw new \Exception('Invalid page size passed');
        }
        
        $response = $this->client->sendApiRequest('/audiences', 
                array(
                    'project_id'=>$projectId,
                    'page'=>$page,
                    'per_page'=>$perPage
                ));
        
        $audiences = array();
        foreach ($response as $audienceInfo) {
            $audience = new Audience($audienceInfo);
            $audiences[] = $audience;
        }
        
        return $audiences;
    }
    
    /**
     * Get metadata for a single Audience.
     * @param type $audienceId
     * @return Audience
     * @throws \Exception
     */
    public function get($audienceId)
    {
        if (!is_int($audienceId)) {
            throw new \Exception("Integer audience ID expected, while got '$audienceId'");
        }
        
        $response = $this->client->sendApiRequest("/audiences/$audienceId");
        
        $audience = new Audience($response);
        
        return $audience;
    }
    
    /**
     * Create an Audience for a Project.
     * @param Audience $audience
     */
    public function create($audience)
    {
        if (!($audience instanceOf \WebMarketingROI\OptimizelyPHP\Resource\v2\Audience)) {
            throw new \Exception("Expected argument of type Audience");
        }
        
        $postData = $audience->toArray();
        
        $response = $this->client->sendApiRequest("/audiences", array(), 'POST', 
                $postData, array(201));
        
        return new Audience($response);
    }
    
    /**
     * Update an Audience for a Project
     * @param integer $audienceId
     * @param Audience $audience
     * @throws \Exception
     */
    public function update($audienceId, $audience) 
    {
        if (!($audience instanceOf \WebMarketingROI\OptimizelyPHP\Resource\v2\Audience)) {
            throw new \Exception("Expected argument of type Audience");
        }
        
        $postData = $audience->toArray();
                
        $response = $this->client->sendApiRequest("/audiences/$audienceId", array(), 'PATCH', 
                $postData, array(200));
        
        return new Audience($response);
    }
}





