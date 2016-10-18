<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 06 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Service\v2;

use WebMarketingROI\OptimizelyPHP\Resource\v2\Campaign;
use WebMarketingROI\OptimizelyPHP\Resource\v2\CampaignResults;

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
     * @return array[Campaign]
     * @throws \Exception
     */
    public function listAll($projectId, $page=0, $perPage=10)
    {
        if (!is_int($projectId)) {
            throw new \Exception("Integer project ID expected, while got '$projectId'");
        }
        
        if ($projectId<0) {
            throw new \Exception("Expected positive integer project ID");
        }
        
        if ($page<0) {
            throw new \Exception('Invalid page number passed');
        }
        
        if ($perPage<0) {
            throw new \Exception('Invalid page size passed');
        }
        
        $response = $this->client->sendApiRequest('/campaigns', 
                array(
                    'project_id'=>$projectId,
                    'page'=>$page,
                    'per_page'=>$perPage
                ));
        
        $campaigns = array();
        foreach ($response as $campaignInfo) {
            $campaign = new Campaign($campaignInfo);
            $campaigns[] = $campaign;
        }
        
        return $campaigns;
    }
    
    /**
     * Reads a campaign.
     * @param integer $campaignId
     * @return Campaign
     * @throws \Exception
     */
    public function get($campaignId)
    {
        if (!is_int($campaignId)) {
            throw new \Exception("Integer campaign ID expected, while got '$campaignId'");
        }
        
        $response = $this->client->sendApiRequest("/campaigns/$campaignId");
        
        $campaign = new Campaign($response);
        
        return $campaign;
    }
    
    /**
     * Get campaign results
     * @param integer $campaignId The id for the campaign you want results for
     * @param string $starTime The earliest time to count events in results. Defaults to the time that the campaign was first activated.
     * @param string $endTime The latest time to count events in results. Defaults to the time the campaign was last active or the current time if the campaign is still running.
     * @throws \Exception
     */
    public function getResults($campaignId, $startTime = null, $endTime = null)
    {
        if (!is_int($campaignId)) {
            throw new \Exception("Integer campaign ID expected, while got '$campaignId'");
        }
        
        if ($campaignId<0) {
            throw new \Exception("Expected positive integer campaign ID");
        }
        
        $response = $this->client->sendApiRequest("/campaigns/$campaignId/results", 
                array(
                    'campaign_id' => $campaignId,
                    'start_time' => $startTime,
                    'end_time' => $endTime
                ));
        
        $results = new CampaignResults($response);
        
        return $results;
    }
    
    /**
     * Create a new Campaign in your account
     * @param Campaign $campaign
     */
    public function create($campaign)
    {
        if (!($campaign instanceOf \WebMarketingROI\OptimizelyPHP\Resource\v2\Campaign)) {
            throw new \Exception("Expected argument of type Campaign");
        }
        
        $postData = $campaign->toArray();
        
        $response = $this->client->sendApiRequest("/campaigns", array(), 'POST', 
                $postData, array(201));
        
        return new Campaign($response);
    }
    
    /**
     * Update a Campaign
     * @param integer $campaignId
     * @param Campaign $campaign
     * @throws \Exception
     */
    public function update($campaignId, $campaign) 
    {
        if (!($campaign instanceOf \WebMarketingROI\OptimizelyPHP\Resource\v2\Campaign)) {
            throw new \Exception("Expected argument of type Campaign");
        }
        
        $postData = $campaign->toArray();
                
        $response = $this->client->sendApiRequest("/campaigns/$campaignId", array(), 'PATCH', 
                $postData, array(200));
        
        return new Campaign($response);
    }
    
    /**
     * Delete Campaign by ID
     * @param integer $campaignId
     * @throws \Exception
     */
    public function delete($campaignId) 
    {
        $response = $this->client->sendApiRequest("/campaigns/$campaignId", array(), 'DELETE', 
                array(), array(200));
    }
}



