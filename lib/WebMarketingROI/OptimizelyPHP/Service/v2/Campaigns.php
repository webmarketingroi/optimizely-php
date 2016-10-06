<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 06 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Service\v2;

use WebMarketingROI\OptimizelyPHP\Resource\v2\Campign;

/**
 * Provides methods for working with Optimizely campaigns.
 */
class Campaigns
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
     * Returns the list of campaigns.
     * @param integer $projectId
     * @param integer $page
     * @param integer $perPage
     * @return array
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
        
        $response = $this->client->sendHttpRequest('/campaigns', 
                array(
                    'project_id'=>$projectId,
                    'page'=>$page,
                    'per_page'=>$perPage
                ));
        
        $campaigns = array();
        foreach ($response as $campaignInfo) {
            $campaign = new Campaign($campaignInfo);
            $projects[] = $project;
        }
        
        return $projects;
    }
    
    /**
     * Reads a project.
     * @param type $campaignId
     * @return Campaign
     * @throws \Exception
     */
    public function get($campaignId)
    {
        if (!is_int($campaignId)) {
            throw new \Exception("Integer campaign ID expected, while got '$campaignId'");
        }
        
        $response = $this->client->sendHttpRequest("/campaigns/$campaignId");
        
        $campaign = new Campaign($response);
        
        return $campaign;
    }
    
    /**
     * Returns campaign results.
     * @param type $campaignId
     * @throws \Exception
     */
    public function getResults($campaignId)
    {
        if (!is_int($campaignId)) {
            throw new \Exception("Integer campaign ID expected, while got '$campaignId'");
        }
        
        $response = $this->client->sendHttpRequest("/campaigns/$campaignId/results");
        
        foreach ($response as $result) {
        }
    }
    
    /**
     * Creates a new campaign.
     * @param Campaign $campaign
     */
    public function create($campaign)
    {
        if (!($campaign instanceOf \WebMarketingROI\OptimizelyPHP\Resource\v2\Campaign)) {
            throw new \Exception("Expected argument of type Campaign");
        }
        
        $postData = $campaign->toArray();
        
        $response = $this->client->sendHttpRequest("/campaigns", array(), 'POST', 
                $postData, array(201));
    }
    
    /**
     * Updates the given campaign.
     * @param integer $campaignId
     * @param Project $campaign
     * @throws \Exception
     */
    public function update($campaignId, $campaign) 
    {
        if (!($campaign instanceOf \WebMarketingROI\OptimizelyPHP\Resource\v2\Campaign)) {
            throw new \Exception("Expected argument of type Campaign");
        }
        
        $postData = $campaign->toArray();
                
        $response = $this->client->sendHttpRequest("/campaigns/$campaignId", array(), 'PATCH', 
                $postData, array(200));
    }
    
    /**
     * Deletes the given campaign.
     * @param integer $campaignId
     * @throws \Exception
     */
    public function delete($campaignId) 
    {
        $response = $this->client->sendHttpRequest("/campaigns/$campaignId", array(), 'DELETE', 
                array(), array(200));
    }
}



