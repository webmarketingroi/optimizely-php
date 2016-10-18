<?php
namespace OptimizelyPHPTest\Service\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Service\v2\Pages;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Page;

class PagesTest extends PHPUnit_Framework_TestCase
{
    public function testListAll()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
                        array(
                            "edit_url" => "https://www.optimizely.com",
                            "name" => "Home Page",
                            "project_id" => 1000,
                            "activation_code" => "string",
                            "activation_type" => "immediate",
                            "archived" => false,
                            "category" => "article",
                            "conditions" => "string",
                            "key" => "home_page",
                            "page_type" => "single_url",
                            "created" => "2016-10-18T05:07:04.096Z",
                            "id" => 4000,
                            "last_modified" => "2016-10-18T05:07:04.096Z"
                        )
                    ));
        
        $pagesService = new Pages($optimizelyApiClientMock);
        
        $pages = $pagesService->listAll(1000);
        
        $this->assertTrue(count($pages)==1);
        $this->assertTrue($pages[0] instanceOf Page);
        $this->assertTrue($pages[0]->getName()=='Home Page');        
    }
    
    public function testGet()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
                            "edit_url" => "https://www.optimizely.com",
                            "name" => "Home Page",
                            "project_id" => 1000,
                            "activation_code" => "string",
                            "activation_type" => "immediate",
                            "archived" => false,
                            "category" => "article",
                            "conditions" => "string",
                            "key" => "home_page",
                            "page_type" => "single_url",
                            "created" => "2016-10-18T05:07:04.104Z",
                            "id" => 4000,
                            "last_modified" => "2016-10-18T05:07:04.104Z"
                        ));
        
        $pagesService = new Pages($optimizelyApiClientMock);
        
        $page = $pagesService->get(5000);
        
        $this->assertTrue($page instanceOf Page);
        $this->assertTrue($page->getName()=='Home Page');        
    }
    
    public function testCreate()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
                            "edit_url" => "https://www.optimizely.com",
                            "name" => "Home Page",
                            "project_id" => 1000,
                            "activation_code" => "string",
                            "activation_type" => "immediate",
                            "archived" => false,
                            "category" => "article",
                            "conditions" => "string",
                            "key" => "home_page",
                            "page_type" => "single_url",
                            "created" => "2016-10-18T05:07:04.113Z",
                            "id" => 4000,
                            "last_modified" => "2016-10-18T05:07:04.113Z"
                        ));
        
        $pagesService = new Pages($optimizelyApiClientMock);
        
        $page = new Page(array(
            "edit_url" => "https://www.optimizely.com",
            "name" => "Home Page",
            "project_id" => 1000,
            "activation_code" => "string",
            "activation_type" => "immediate",
            "archived" => false,
            "category" => "article",
            "conditions" => "string",
            "key" => "home_page",
            "page_type" => "single_url"
        ));
        
        $createdPage = $pagesService->create($page);
        
        $this->assertTrue($createdPage instanceOf Page);
        $this->assertTrue($createdPage->getName()=='Home Page');                
    }
    
    public function testUpdate()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
                            "edit_url" => "https://www.optimizely.com",
                            "name" => "Home Page",
                            "project_id" => 1000,
                            "activation_code" => "string",
                            "activation_type" => "immediate",
                            "archived" => false,
                            "category" => "article",
                            "conditions" => "string",
                            "key" => "home_page",
                            "page_type" => "single_url",
                            "created" => "2016-10-18T05:07:04.113Z",
                            "id" => 4000,
                            "last_modified" => "2016-10-18T05:07:04.113Z"
                        ));
        
        $pagesService = new Pages($optimizelyApiClientMock);
        
        $page = new Page(array(
            "edit_url" => "https://www.optimizely.com",
            "name" => "Home Page",
            "project_id" => 1000,
            "activation_code" => "string",
            "activation_type" => "immediate",
            "archived" => false,
            "category" => "article",
            "conditions" => "string",
            "key" => "home_page",
            "page_type" => "single_url"
        ));
        
        $updatedPage = $pagesService->update(1000, $page);
        
        $this->assertTrue($updatedPage instanceOf Page);
        $this->assertTrue($updatedPage->getName()=='Home Page');                  
    }
    
    public function testDelete()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(                        
                        ));
        
        $pagesService = new Pages($optimizelyApiClientMock);
     
        $pagesService->delete(1000);
    }
}

