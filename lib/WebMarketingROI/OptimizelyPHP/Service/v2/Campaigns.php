<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 06 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Service\v2;

use WebMarketingROI\OptimizelyPHP\Exception;
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
     * @return Result
     * @throws Exception
     */
    public function listAll($projectId, $page=1, $perPage=25)
    {
        if (!is_int($projectId)) {
            throw new Exception("Integer project ID expected, while got '$projectId'");
        }
        
        if ($projectId<0) {
            throw new Exception("Expected positive integer project ID");
        }
        
        if ($page<0) {
            throw new Exception('Invalid page number passed');
        }
        
        if ($perPage<0 || $perPage>100) {
            throw new Exception('Invalid page size passed');
        }
        
        $result = $this->client->sendApiRequest('/campaigns', 
                array(
                    'project_id'=>$projectId,
                    'page'=>$page,
                    'per_page'=>$perPage
                ));
        
        $campaigns = array();
        foreach ($result->getDecodedJsonData() as $campaignInfo) {
            $campaign = new Campaign($campaignInfo);
            $campaigns[] = $campaign;
        }
        $result->setPayload($campaigns);
        
        return $result;
    }
    
    /**
     * Reads a campaign.
     * @param integer $campaignId
     * @return Result
     * @throws Exception
     */
    public function get($campaignId)
    {
        if (!is_int($campaignId)) {
            throw new Exception("Integer campaign ID expected, while got '$campaignId'");
        }
        
        $result = $this->client->sendApiRequest("/campaigns/$campaignId");
        
        $campaign = new Campaign($result->getDecodedJsonData());
        $result->setPayload($campaign);
        
        return $result;
    }
    
    /**
     * Get campaign results
     * @param integer $campaignId The id for the campaign you want results for
     * @param string $starTime The earliest time to count events in results. Defaults to the time that the campaign was first activated.
     * @param string $endTime The latest time to count events in results. Defaults to the time the campaign was last active or the current time if the campaign is still running.
     * @return Result
     * @throws Exception
     */
    public function getResults($campaignId, $startTime = null, $endTime = null)
    {
        if (!is_int($campaignId)) {
            throw new Exception("Integer campaign ID expected, while got '$campaignId'",
                    Exception::CODE_INVALID_ARG);
        }
        
        if ($campaignId<0) {
            throw new Exception("Expected positive integer campaign ID",
                    Exception::CODE_INVALID_ARG);
        }
        
        $result = $this->client->sendApiRequest("/campaigns/$campaignId/results", 
                array(
                    'campaign_id' => $campaignId,
                    'start_time' => $startTime,
                    'end_time' => $endTime
                ));
        
        $campaignResults = new CampaignResults($result->getDecodedJsonData());
        $result->setPayload($campaignResults);
        
        return $result;
    }
    
    /**
     * Create a new Campaign in your account
     * @param Campaign $campaign
     * @return Result
     * @throws Exception
     */
    public function create($campaign)
    {
        if (!($campaign instanceOf Campaign)) {
            throw new Exception("Expected argument of type Campaign",
                    Exception::CODE_INVALID_ARG);
        }
        
        $postData = $campaign->toArray();
        
        $result = $this->client->sendApiRequest("/campaigns", array(), 'POST', 
                $postData);
        
        $campaign = new Campaign($result->getDecodedJsonData());
        $result->setPayload($campaign);
        
        return $result;
    }
    
    /**
     * Update a Campaign
     * @param integer $campaignId
     * @param Campaign $campaign
     * @return Result
     * @throws Exception
     */
    public function update($campaignId, $campaign) 
    {
        if (!($campaign instanceOf Campaign)) {
            throw new Exception("Expected argument of type Campaign",
                    Exception::CODE_INVALID_ARG);
        }
        
        $postData = $campaign->toArray();
                
        $result = $this->client->sendApiRequest("/campaigns/$campaignId", array(), 'PATCH', 
                $postData);
        
        $campaign = new Campaign($result->getDecodedJsonData());
        $result->setPayload($campaign);
        
        return $result;
    }
    
    /**
     * Delete Campaign by ID
     * @param integer $campaignId
     * @return Result
     * @throws Exception
     */
    public function delete($campaignId) 
    {
        $result = $this->client->sendApiRequest("/campaigns/$campaignId", array(), 'DELETE', 
                array());
        
        return $result;
    }
}



