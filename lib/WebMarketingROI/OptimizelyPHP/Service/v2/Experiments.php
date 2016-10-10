<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 03 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Service\v2;

use WebMarketingROI\OptimizelyPHP\Resource\v2\Experiment;

/**
 * Provides methods for working with Optimizely experiments.
 */
class Experiments 
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
     * Returns the list of experiments.
     * @param integer $projectId
     * @param integer $campaignId
     * @param boolean $includeClassic
     * @param integer $page
     * @param integer $perPage
     * @return array
     * @throws \Exception
     */
    public function listAll($projectId, $campaignId=null, $includeClassic=false, $page=1, $perPage=10)
    {
        if (empty($projectId) && empty($campaignId)) {
            throw new \Exception('Project ID or Campaign ID must be not-empty');
        }
        
        $response = $this->client->sendApiRequest('/experiments', 
                array(
                    'project_id'=>$projectId, 
                    'campaign_id'=>$campaignId,
                    'include_classic'=>$includeClassic,
                    'page'=>$page,
                    'per_page'=>$perPage
                ));
        
        $experiments = array();
        foreach ($response as $experimentInfo) {
            $experiment = new Experiment($experimentInfo);
            $experiments[] = $experiment;
        }
        
        return $experiments;
    }
    
    public function get($experimentId)
    {
        if (!is_int($experimentId)) {
            throw new \Exception("Integer experiment ID expected, while got '$experimentId'");
        }
        
        $response = $this->client->sendApiRequest("/experiments/$experimentId");
    }
}

