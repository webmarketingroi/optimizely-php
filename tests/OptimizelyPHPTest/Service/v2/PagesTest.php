<?php
namespace OptimizelyPHPTest\Service\v2;

use OptimizelyPHPTest\Service\v2\BaseServiceTest;
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Result;
use WebMarketingROI\OptimizelyPHP\Service\v2\Pages;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Page;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Project;

class PagesTest extends BaseServiceTest
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
    
    public function testIntegration()
    {
        if (!getenv('OPTIMIZELY_PHP_TEST_INTEGRATION')) 
            $this->markTestSkipped('OPTIMIZELY_PHP_TEST_INTEGRATION env var is not set');
        
        $credentials = $this->loadCredentialsFromFile();
        
        $optimizelyClient = new OptimizelyApiClient($credentials, 'v2');
        $this->assertTrue($optimizelyClient!=null);
        
        // Create new project        
        $curDate = date('Y-m-d H:i:s');
        $newProject = new Project(array(
            "name" => "Test Project $curDate",
            "account_id" => 12345,
            "confidence_threshold" => 0.9,
            "platform" => "web",
            "status" => "active",
            "web_snippet" => array(
              "enable_force_variation" => false,
              "exclude_disabled_experiments" => false,
              "exclude_names" => true,
              "include_jquery" => true,
              "ip_anonymization" => false,
              "ip_filter" => "^206\\.23\\.100\\.([5-9][0-9]|1([0-4][0-9]|50))$",
              "library" => "jquery-1.11.3-trim",
              "project_javascript" => "alert(\"Active Experiment\")"
            )
        ));
        
        $result = $optimizelyClient->projects()->create($newProject);
        $createdProject = $result->getPayload();
        
        // Create new page in the project
        $page = new Page(array(
            "edit_url" => "https://www.optimizely.com",
            "name" => "Home Page",
            "project_id" => $createdProject->getId(),
            "activation_code" => "string",
            "activation_type" => "immediate",
            "archived" => false,
            "category" => "article",
            "conditions" => "[\"and\", {\"type\": \"url\", \"match_type\": \"substring\", \"value\": \"optimize\"}]",
            "key" => "home_page",
            "page_type" => "single_url",
            "created" => "2016-10-18T05:07:04.113Z",
            "id" => 4000,
            "last_modified" => "2016-10-18T05:07:04.113Z"
        ));
        
        $result = $optimizelyClient->pages()->create($page);
        $createdPage = $result->getPayload();
        
        $this->assertTrue($createdPage instanceOf Page);
        $this->assertTrue($createdPage->getName()=='Home Page');  
        
        // List all existing pages and try to find the created page
        $pageFound = false;        
        try {
            $page = 1;
            for (;;) {                            
                $result = $optimizelyClient->pages()->listAll($createdProject->getId(), $page);

                $pages = $result->getPayload();

                foreach ($pages as $pageObject) {
                    if ($pageObject->getName()=="Home Page") {
                        $pageFound = true;
                        break;
                    }
                }

                if ($result->getNextPage()==null)
                    break;

                $page ++;
            }
        }
        catch (Exception $e) {
            // Handle error.
            $code = $e->getCode();
            $httpCode = $e->getHttpCode();
            $message = $e->getMessage();
            $uuid = $e->getUuid();
            echo "Exception caught: $message (code=$code http_code=$httpCode uuid=$uuid)\n";
        }
        
        $this->assertTrue($pageFound);
        
        // Update page
        $createdPage->setName('Some new page name');
        $result = $optimizelyClient->pages()->update($createdPage->getId(), $createdPage);
        $updatedPage = $result->getPayload();                
        
        $this->assertTrue($updatedPage instanceOf Page);
        $this->assertTrue($updatedPage->getName()=='Some new page name');  
        
        // Make project archived
        
        $createdProject->setStatus('archived');
        $result = $optimizelyClient->projects()->update($createdProject->getId(), $createdProject);
        $updatedProject = $result->getPayload();
        
        $this->assertEquals('archived', $updatedProject->getStatus());
    }
}

