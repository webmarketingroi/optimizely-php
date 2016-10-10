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
     * Returns the list of projects.
     * @param integer $page
     * @param integer $perPage
     * @return array
     * @throws \Exception
     */
    public function listAll($page=0, $perPage=10)
    {
        if ($page<0) {
            throw new \Exception('Invalid page number passed');
        }
        
        if ($perPage<0) {
            throw new \Exception('Invalid page size passed');
        }
        
        $response = $this->client->sendApiRequest('/projects', 
                array(
                    'page'=>$page,
                    'per_page'=>$perPage
                ));
        
        $projects = array();
        foreach ($response as $projectInfo) {
            $project = new Project($projectInfo);
            $projects[] = $project;
        }
        
        return $projects;
    }
    
    /**
     * Reads a project.
     * @param type $projectId
     * @return Project
     * @throws \Exception
     */
    public function get($projectId)
    {
        if (!is_int($projectId)) {
            throw new \Exception("Integer project ID expected, while got '$projectId'");
        }
        
        $response = $this->client->sendApiRequest("/projects/$projectId");
        
        $project = new Project($response);
        
        return $project;
    }
    
    /**
     * Creates a new project.
     * @param Project $project
     */
    public function create($project)
    {
        if (!($project instanceOf \WebMarketingROI\OptimizelyPHP\Resource\v2\Project)) {
            throw new \Exception("Expected argument of type Project");
        }
        
        $postData = $project->toArray();
        
        $response = $this->client->sendApiRequest("/projects", array(), 'POST', 
                $postData, array(201));
    }
    
    /**
     * Updates the given project.
     * @param integer $projectId
     * @param Project $project
     * @throws \Exception
     */
    public function update($projectId, $project) 
    {
        if (!($project instanceOf \WebMarketingROI\OptimizelyPHP\Resource\v2\Project)) {
            throw new \Exception("Expected argument of type Project");
        }
        
        $postData = $project->toArray();
                
        $response = $this->client->sendApiRequest("/projects/$projectId", array(), 'PATCH', 
                $postData, array(200));
    }
}

