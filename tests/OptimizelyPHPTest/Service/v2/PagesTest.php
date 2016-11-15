<?php
namespace OptimizelyPHPTest\Service\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Result;
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

        $result = new Result(array(
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
                    ), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $pagesService = new Pages($optimizelyApiClientMock);
        
        $result = $pagesService->listAll(1000);
        $pages = $result->getPayload();
        
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

        $result = new Result(array(
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
                        ), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $pagesService = new Pages($optimizelyApiClientMock);
        
        $result = $pagesService->get(5000);
        $page = $result->getPayload();
                
        $this->assertTrue($page instanceOf Page);
        $this->assertEquals('Home Page', $page->getName());        
    }
    
    public function testCreate()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
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
                        ), 201);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
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
        
        $result = $pagesService->create($page);
        $createdPage = $result->getPayload();
        
        $this->assertTrue($createdPage instanceOf Page);
        $this->assertTrue($createdPage->getName()=='Home Page');                
    }
    
    public function testUpdate()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
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
                        ), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
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
        
        $result = $pagesService->update(1000, $page);
        $updatedPage = $result->getPayload();
        
        $this->assertTrue($updatedPage instanceOf Page);
        $this->assertTrue($updatedPage->getName()=='Home Page');                  
    }
    
    public function testDelete()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $pagesService = new Pages($optimizelyApiClientMock);
     
        $result = $pagesService->delete(1000);
        
        $this->assertEquals(200, $result->getHttpCode());
    }
}

