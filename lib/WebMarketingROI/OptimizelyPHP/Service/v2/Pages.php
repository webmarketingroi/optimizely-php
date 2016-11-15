<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 07 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Service\v2;

use WebMarketingROI\OptimizelyPHP\Resource\v2\Page;
use WebMarketingROI\OptimizelyPHP\Exception;

/**
 * Provides methods for working with Optimizely project pages.
 */
class Pages
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
     * List all Pages for a project.
     * @param integer $projectId
     * @param integer $page
     * @param integer $perPage
     * @return Result
     * @throws Exception
     */
    public function listAll($projectId, $page=1, $perPage=25)
    {
        if ($page<0) {
            throw new Exception('Invalid page number passed');
        }
        
        if ($perPage<0) {
            throw new Exception('Invalid page size passed');
        }
        
        $result = $this->client->sendApiRequest('/pages', 
                array(
                    'project_id'=>$projectId,
                    'page'=>$page,
                    'per_page'=>$perPage
                ));
        
        $pages = array();
        foreach ($result->getDecodedJsonData() as $pageInfo) {
            $page = new Page($pageInfo);
            $pages[] = $page;
        }
        $result->setPayload($pages);
        
        return $result;
    }
    
    /**
     * Get metadata for a single Page
     * @param integer $pageId
     * @return Result
     * @throws Exception
     */
    public function get($pageId)
    {
        if (!is_int($pageId)) {
            throw new Exception("Integer page ID expected, while got '$pageId'");
        }
        
        $result = $this->client->sendApiRequest("/pages/$pageId");
        
        $page = new Page($result->getDecodedJsonData());
        $result->setPayload($page);
        
        return $result;
    }
    
    /**
     * Create a new Page in a provided Project
     * @param Page $page
     */
    public function create($page)
    {
        if (!($page instanceOf Page)) {
            throw new Exception("Expected argument of type Page");
        }
        
        $postData = $page->toArray();
        
        $result = $this->client->sendApiRequest("/pages", array(), 'POST', 
                $postData);
        
        $page = new Page($result->getDecodedJsonData());
        $result->setPayload($page);
        
        return $result;
    }
    
    /**
     * Update a Page in a provided Project
     * @param integer $pageId
     * @param Audience $page
     * @return Result
     * @throws Exception
     */
    public function update($pageId, $page) 
    {
        if (!($page instanceOf Page)) {
            throw new Exception("Expected argument of type Page");
        }
        
        $postData = $page->toArray();
                
        $result = $this->client->sendApiRequest("/pages/$pageId", array(), 'PATCH', 
                $postData);
        
        $page = new Page($result->getDecodedJsonData());
        $result->setPayload($page);
        
        return $result;
    }
    
    /**
     * Delete a Page within a Project by ID.
     * @param integer $pageId
     * @return Result
     * @throws Exception
     */
    public function delete($pageId) 
    {
        $result = $this->client->sendApiRequest("/pages/$pageId", array(), 'DELETE', 
                array());
        
        return $result;
    }
}






