<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 07 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Service\v2;

use WebMarketingROI\OptimizelyPHP\Resource\v2\Page;

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
     * Returns the list of audiences.
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
        
        $response = $this->client->sendHttpRequest('/pages', 
                array(
                    'project_id'=>$projectId,
                    'page'=>$page,
                    'per_page'=>$perPage
                ));
        
        $pages = array();
        foreach ($response as $pageInfo) {
            $page = new Page($pageInfo);
            $pages[] = $page;
        }
        
        return pages;
    }
    
    /**
     * Reads a page.
     * @param type $pageId
     * @return Page
     * @throws \Exception
     */
    public function get($pageId)
    {
        if (!is_int($pageId)) {
            throw new \Exception("Integer page ID expected, while got 'pageId'");
        }
        
        $response = $this->client->sendHttpRequest("/pages/$pageId");
        
        $page = new Page($response);
        
        return $page;
    }
    
    /**
     * Creates a new page.
     * @param Page $page
     */
    public function create($page)
    {
        if (!($page instanceOf \WebMarketingROI\OptimizelyPHP\Resource\v2\Page)) {
            throw new \Exception("Expected argument of type Page");
        }
        
        $postData = $page->toArray();
        
        $response = $this->client->sendHttpRequest("/pages", array(), 'POST', 
                $postData, array(201));
    }
    
    /**
     * Updates the given page.
     * @param integer $pageId
     * @param Audience $page
     * @throws \Exception
     */
    public function update($pageId, $page) 
    {
        if (!($page instanceOf \WebMarketingROI\OptimizelyPHP\Resource\v2\Page)) {
            throw new \Exception("Expected argument of type Page");
        }
        
        $postData = $page->toArray();
                
        $response = $this->client->sendHttpRequest("/pages/$pageId", array(), 'PATCH', 
                $postData, array(200));
    }
    
    /**
     * Deletes the given page.
     * @param integer $pageId
     * @throws \Exception
     */
    public function delete($pageId) 
    {
        $response = $this->client->sendHttpRequest("/pages/$pageId", array(), 'DELETE', 
                array(), array(200));
    }
}






