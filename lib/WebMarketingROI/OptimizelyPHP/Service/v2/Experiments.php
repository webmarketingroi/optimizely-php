<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 03 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Service\v2;

use WebMarketingROI\OptimizelyPHP\Resource\v2\Experiment;
use WebMarketingROI\OptimizelyPHP\Resource\v2\ExperimentResults;

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
     * Get a list of all the experiments by Project or Campaign
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
            throw new \Exception('Project ID or Campaign ID must be non-empty');
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
    
    /**
     * Get metadata for a single Experiment.
     * @param integer $experimentId
     * @throws \Exception
     */
    public function get($experimentId)
    {
        if (!is_int($experimentId)) {
            throw new \Exception("Integer experiment ID expected, while got '$experimentId'");
        }
        
        $response = $this->client->sendApiRequest("/experiments/$experimentId");
    }
    
    /**
     * Get results for a single experiment
     * @param integer $experimentId The id for the experiment you want results for
     * @param integer $baselineVariationId The id of the variation to use as the baseline to compare against other variations. Defaults to the first variation if not provided.
     * @param string $startTime The earliest time to count events in results. Defaults to the time that the experiment was first activated.
     * @param string $endTime The latest time to count events in results. Defaults to the time the experiment was last active or the current time if the experiment is still running.
     * @throws \Exception
     */
    public function getResults($experimentId, $baselineVariationId, $startTime, $endTime)
    {
        if (!is_int($experimentId)) {
            throw new \Exception("Integer experiment ID expected, while got '$experimentId'");
        }
        
        $response = $this->client->sendApiRequest("/experiments/$experimentId/results",
                array(
                    'baseline_variation_id' => $baselineVariationId,
                    'start_time' => $startTime,
                    'end_time' => $endTime
                ));
        
        $results = new ExperimentResults($response);
        
        return $results;
    }
    
    /**
     * Create an experiment in a Project.
     * @param Experiment $experiment
     * @param boolean $publish Set to true to make the the experiment live to the world upon creation.
     */
    public function create($experiment, $publish)
    {
        if (!($experiment instanceOf Experiment)) {
            throw new \Exception("Expected argument of type Experiment");
        }
        
        $postData = array(
            'publish' => $publish,
            'body' => $experiment->toArray()
        );
        
        $response = $this->client->sendApiRequest("/experiments", array(), 'POST', 
                $postData, array(201));
    }
    
    /**
     * Update an Experiment by ID
     * @param integer $experimentId
     * @param Experiment $experiment
     * @param boolean $overrideChanges If there are draft changes already in the experiment, you can override those changes by providing this query parameter.
     * @param boolean $publish Whether to publish the changes to the world.
     * @throws \Exception
     */
    public function update($experimentId, $experiment, $overrideChanges, $publish) 
    {
        if (!($experiment instanceOf Experiment)) {
            throw new \Exception("Expected argument of type Experiment");
        }
        
        $postData = array(            
            'body' => $experiment->toArray(),
            'override_changes' => $overrideChanges,
            'publish' => $publish
        );
                
        $response = $this->client->sendApiRequest("/campaigns/$campaignId", array(), 'PATCH', 
                $postData, array(200));
    }
    
    /**
     * Delete Experiment by ID
     * @param integer $experimentId
     * @throws \Exception
     */
    public function delete($experimentId) 
    {
        $response = $this->client->sendApiRequest("/experiments/$experimentId", array(), 'DELETE', 
                array(), array(200));
    }
}

