<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 05 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Service\v2;

use WebMarketingROI\OptimizelyPHP\Resource\v2\Project;

/**
 * Provides methods for working with Optimizely projects.
 */
class Projects
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
    
    /**
     * Returns the list of projects.
     * @param integer $page
     * @param integer $perPage
     * @return array
     * @throws \Exception
     */
    public function listAll($page=0, $perPage=10)
    {
        if (empty($page<0)) {
            throw new \Exception('Invalid page number passed');
        }
        
        $response = $this->client->sendHttpRequest('/projects', 
                array(
                    'page'=>$page,
                    'per_page'=>$perPage
                ));
        
        $projects = array();
        foreach ($response as $projectInfo) {
            $project = new Experiment($projectInfo);
            $projects[] = $project;
        }
        
        return $projects;
    }
    
    public function get($projectId)
    {
        if (!is_int($projectId)) {
            throw new \Exception("Integer project ID expected, while got '$projectId'");
        }
        
        $response = $this->client->sendHttpRequest("/projects/$projectId");
    }
}

