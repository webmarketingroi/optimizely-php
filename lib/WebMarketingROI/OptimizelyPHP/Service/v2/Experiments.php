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
     * @return Result
     * @throws Exception
     */
    public function listAll($projectId, $campaignId=null, $includeClassic=false, $page=1, $perPage=25)
    {
        if (empty($projectId) && empty($campaignId)) {
            throw new Exception('Project ID or Campaign ID must be non-empty',
                    Exception::ERROR_INVALID_ARG);
        }
        
        $result = $this->client->sendApiRequest('/experiments', 
                array(
                    'project_id'=>$projectId, 
                    'campaign_id'=>$campaignId,
                    'include_classic'=>$includeClassic,
                    'page'=>$page,
                    'per_page'=>$perPage
                ));
        
        $experiments = array();
        foreach ($result->getDecodedJsonData() as $experimentInfo) {
            $experiment = new Experiment($experimentInfo);
            $experiments[] = $experiment;
        }
        $result->setPayload($experiments);
        
        return $result;
    }
    
    /**
     * Get metadata for a single Experiment.
     * @param integer $experimentId
     * @return Result
     * @throws Exception
     */
    public function get($experimentId)
    {
        if (!is_int($experimentId)) {
            throw new Exception("Integer experiment ID expected, while got '$experimentId'",
                    Exception::CODE_INVALID_ARG);
        }
        
        $result = $this->client->sendApiRequest("/experiments/$experimentId");
        
        $experiment = new Experiment($result->getDecodedJsonData());
        $result->setPayload($experiment);
        
        return $result;
    }
    
    /**
     * Get results for a single experiment
     * @param integer $experimentId The id for the experiment you want results for
     * @param integer $baselineVariationId The id of the variation to use as the baseline to compare against other variations. Defaults to the first variation if not provided.
     * @param string $startTime The earliest time to count events in results. Defaults to the time that the experiment was first activated.
     * @param string $endTime The latest time to count events in results. Defaults to the time the experiment was last active or the current time if the experiment is still running.
     * @return Result
     * @throws Exception
     */
    public function getResults($experimentId, $baselineVariationId = null, $startTime = null, $endTime = null)
    {
        if (!is_int($experimentId)) {
            throw new Exception("Integer experiment ID expected, while got '$experimentId'",
                    Exception::CODE_INVALID_ARG);
        }
        
        $result = $this->client->sendApiRequest("/experiments/$experimentId/results",
                array(
                    'baseline_variation_id' => $baselineVariationId,
                    'start_time' => $startTime,
                    'end_time' => $endTime
                ));
        
        $experimentResults = new ExperimentResults($result->getDecodedJsonData());
        $result->setPayload($experimentResults);
        
        return $result;
    }
    
    /**
     * Create an experiment in a Project.
     * @param Experiment $experiment
     * @param boolean $publish Set to true to make the the experiment live to the world upon creation.
     * @return Result
     * @throw Exception
     */
    public function create($experiment, $publish)
    {
        if (!($experiment instanceOf Experiment)) {
            throw new Exception("Expected argument of type Experiment",
                    Exception::CODE_INVALID_ARG);
        }
        
        if (!is_bool($publish)) {
            throw new Exception("Expected boolean publish argument",
                    Exception::CODE_INVALID_ARG);
        }
        
        $queryParams = array(
            'publish' => $publish,            
        );
        
        $postData = $experiment->toArray();
        
        $result = $this->client->sendApiRequest("/experiments", $queryParams, 'POST', 
                $postData);
        
        $experiment = new Experiment($result->getDecodedJsonData());
        $result->setPayload($experiment);
        
        return $result;
    }
    
    /**
     * Update an Experiment by ID
     * @param integer $experimentId
     * @param Experiment $experiment
     * @param boolean $overrideChanges If there are draft changes already in the experiment, you can override those changes by providing this query parameter.
     * @param boolean $publish Whether to publish the changes to the world.
     * @return Result
     * @throws Exception
     */
    public function update($experimentId, $experiment, $overrideChanges, $publish) 
    {
        if (!is_int($experimentId)) {
            throw new Exception("Expected argument of type Experiment");
        }
        
        if ($experimentId<0) {
            throw new Exception("Expected positive experiment ID argument");
        }
        
        if (!($experiment instanceOf Experiment)) {
            throw new Exception("Expected argument of type Experiment");
        }
        
        $queryParams = array(
            'override_changes' => $overrideChanges,
            'publish' => $publish
        );
        
        $postData = $experiment->toArray();
              
        $result = $this->client->sendApiRequest("/experiments/$experimentId", $queryParams, 'PATCH', 
                $postData);
        
        $experiment = new Experiment($result->getDecodedJsonData());
        $result->setPayload($experiment);
        
        return $result;
    }
    
    /**
     * Delete Experiment by ID
     * @param integer $experimentId
     * @return Result
     * @throws Exception
     */
    public function delete($experimentId) 
    {
        $result = $this->client->sendApiRequest("/experiments/$experimentId", array(), 'DELETE', 
                array());
        
        return $result;
    }
}

