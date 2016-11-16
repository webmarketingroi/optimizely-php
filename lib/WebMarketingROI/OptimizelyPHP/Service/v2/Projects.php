<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 05 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Service\v2;

use WebMarketingROI\OptimizelyPHP\Exception;
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
     * Get a list of all the Projects in your account, with associated metadata.
     * @param integer $page Page number (1-based).
     * @param integer $perPage Count of projects per page (25 by default).
     * @return Result
     * @throws Exception
     */
    public function listAll($page=1, $perPage=25)
    {
        if ($page<0) {
            throw new Exception('Invalid page number passed');
        }
        
        if ($perPage<0 || $perPage>100) {
            throw new Exception('Invalid page size passed');
        }
        
        $result = $this->client->sendApiRequest('/projects', 
                array(
                    'page'=>$page,
                    'per_page'=>$perPage
                ));
        
        $projects = array();
        foreach ($result->getDecodedJsonData() as $projectInfo) {
            $project = new Project($projectInfo);
            $projects[] = $project;
        }
        $result->setPayload($projects);
        
        return $result;
    }
    
    /**
     * Get metadata for a single Project.
     * @param integer $projectId
     * @return Result
     * @throws Exception
     */
    public function get($projectId)
    {
        if (!is_int($projectId)) {
            throw new Exception("Integer project ID expected, while got '$projectId'");
        }
        
        if ($projectId<0) {
            throw new Exception("A positive project ID expected");
        }
        
        $result = $this->client->sendApiRequest("/projects/$projectId");
        
        $project = new Project($result->getDecodedJsonData());
        $result->setPayload($project);
        
        return $result;
    }
    
    /**
     * Create a new Project in your account.
     * @param Project $project Project meta information.
     * @return Result
     */
    public function create($project)
    {
        if (!($project instanceOf Project)) {
            throw new Exception("Expected argument of type Project");
        }
        
        $postData = $project->toArray();
        
        $result = $this->client->sendApiRequest("/projects", array(), 'POST', 
                $postData);
        
        $project = new Project($result->getDecodedJsonData());
        $result->setPayload($project);
        
        return $result;
    }
    
    /**
     * Update a Project.
     * @param integer $projectId
     * @param Project $project
     * @return Result
     * @throws Exception
     */
    public function update($projectId, $project) 
    {
        if (!is_int($projectId)) {
            throw new Exception("Integer project ID expected, while got '$projectId'");
        }
        
        if ($projectId<0) {
            throw new Exception("A positive project ID expected");
        }
        
        if (!($project instanceOf Project)) {
            throw new Exception("Expected argument of type Project");
        }
        
        $postData = $project->toArray();
                
        $result = $this->client->sendApiRequest("/projects/$projectId", array(), 
                'PATCH', $postData);
        
        $project = new Project($result->getDecodedJsonData());
        $result->setPayload($project);
        
        return $result;
    }
}

