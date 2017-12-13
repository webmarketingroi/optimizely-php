<?php
namespace OptimizelyPHPTest\Service\v2;

use OptimizelyPHPTest\Service\v2\BaseServiceTest;
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Result;
use WebMarketingROI\OptimizelyPHP\Service\v2\Events;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Event;
use WebMarketingROI\OptimizelyPHP\Resource\v2\ClickEvent;
use WebMarketingROI\OptimizelyPHP\Resource\v2\CustomEvent;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Project;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Page;

class EventsTest extends BaseServiceTest
{
    public function testListAll()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
                        array(
                            "archived" => true,
                            "category" => "add_to_cart",
                            "description" => "Item added to cart",
                            "event_filter" => array(
                              "filter_type" => "target_selector",
                              "selector" => ".menu-options"
                            ),
                            "event_type" => "custom",
                            "key" => "add_to_cart",
                            "name" => "Add to Cart",
                            "page_id" => 5000,
                            "project_id" => 1000,
                            "created" => "2016-10-18T05:07:04.136Z",
                            "id" => 0,
                            "is_classic" => false,
                            "is_editable" => true
                        )
                    ), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $eventsService = new Events($optimizelyApiClientMock);
        
        $result = $eventsService->listAll(1000, true);
        $events = $result->getPayload();
        
        $this->assertTrue(count($events)==1);
        $this->assertTrue($events[0] instanceOf Event);
        $this->assertTrue($events[0]->getName()=='Add to Cart');        
    }
    
    public function testGet()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
                            "archived" => true,
                            "category" => "add_to_cart",
                            "description" => "Item added to cart",
                            "event_filter" => array(
                              "filter_type" => "target_selector",
                              "selector" => ".menu-options"
                            ),
                            "event_type" => "custom",
                            "key" => "add_to_cart",
                            "name" => "Add to Cart",
                            "page_id" => 5000,
                            "project_id" => 1000,
                            "created" => "2016-10-18T05:07:04.146Z",
                            "id" => 0,
                            "is_classic" => false,
                            "is_editable" => true
                        ), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $eventsService = new Events($optimizelyApiClientMock);
        
        $result = $eventsService->get(5000);
        $event = $result->getPayload();
        
        $this->assertTrue($event instanceOf Event);
        $this->assertTrue($event->getName()=='Add to Cart');        
    }
    
    public function testCreateClickEvent()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
                              "event_filter" => array(
                                "filter_type" => "target_selector",
                                "selector" => ".menu-options"
                              ),
                              "name" => "Add to Cart",
                              "archived" => true,
                              "category" => "add_to_cart",
                              "description" => "string",
                              "event_type" => "click",
                              "key" => "add_to_cart",
                              "created" => "2016-10-18T05:07:04.153Z",
                              "id" => 0,
                              "is_classic" => false,
                              "is_editable" => true,
                              "page_id" => 0,
                              "project_id" => 1000
                        ), 201);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $eventsService = new Events($optimizelyApiClientMock);
        
        $event = new ClickEvent(array(
              "event_filter" => array(
                "filter_type" => "target_selector",
                "selector" => ".menu-options"
              ),
              "name" => "Add to Cart",
              "archived" => true,
              "category" => "add_to_cart",
              "description" => "string",
              "event_type" => "click",
              "key" => "add_to_cart"
        ));
        
        $result = $eventsService->createClickEvent(0, $event);
        $createdEvent = $result->getPayload();
        
        $this->assertTrue($createdEvent instanceOf ClickEvent);
        $this->assertTrue($createdEvent->getName()=='Add to Cart');                
    }
    
    public function testCreateCustomEvent()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
                            "archived" => true,
                            "category" => "add_to_cart",
                            "description" => "string",
                            "event_type" => "custom",
                            "key" => "loaded_new_app",
                            "name" => "Loaded New App",
                            "created" => "2016-10-18T05:07:04.163Z",
                            "id" => 0,
                            "is_classic" => false,
                            "is_editable" => true,
                            "page_id" => 0,
                            "project_id" => 1000  
                        ), 201);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $eventsService = new Events($optimizelyApiClientMock);
        
        $event = new CustomEvent(array(
                "archived" => true,
                "category" => "add_to_cart",
                "description" => "string",
                "event_type" => "custom",
                "key" => "loaded_new_app",
                "name" => "Loaded New App"
        ));
        
        $result = $eventsService->createCustomEvent(0, $event);
        $createdEvent = $result->getPayload();
        
        $this->assertTrue($createdEvent instanceOf CustomEvent);
        $this->assertTrue($createdEvent->getName()=='Loaded New App');                
    }
    
    public function testUpdateClickEvent()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
                              "event_filter" => array(
                                "filter_type" => "target_selector",
                                "selector" => ".menu-options"
                              ),
                              "name" => "Add to Cart",
                              "archived" => true,
                              "category" => "add_to_cart",
                              "description" => "string",
                              "event_type" => "click",
                              "key" => "add_to_cart",
                              "created" => "2016-10-18T05:07:04.153Z",
                              "id" => 0,
                              "is_classic" => false,
                              "is_editable" => true,
                              "page_id" => 0,
                              "project_id" => 1000
                        ), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $eventsService = new Events($optimizelyApiClientMock);
        
        $event = new ClickEvent(array(
              "event_filter" => array(
                "filter_type" => "target_selector",
                "selector" => ".menu-options"
              ),
              "name" => "Add to Cart",
              "archived" => true,
              "category" => "add_to_cart",
              "description" => "string",
              "event_type" => "click",
              "key" => "add_to_cart"
        ));
        
        $result = $eventsService->updateClickEvent(0, 0, $event);
        $updatedEvent = $result->getPayload();
        
        $this->assertTrue($updatedEvent instanceOf ClickEvent);
        $this->assertTrue($updatedEvent->getName()=='Add to Cart');                
    }
    
    public function testUpdateCustomEvent()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
                            "archived" => true,
                            "category" => "add_to_cart",
                            "description" => "string",
                            "event_type" => "custom",
                            "key" => "loaded_new_app",
                            "name" => "Loaded New App",
                            "created" => "2016-10-18T05:07:04.163Z",
                            "id" => 0,
                            "is_classic" => false,
                            "is_editable" => true,
                            "page_id" => 0,
                            "project_id" => 1000  
                        ), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $eventsService = new Events($optimizelyApiClientMock);
        
        $event = new CustomEvent(array(
                "archived" => true,
                "category" => "add_to_cart",
                "description" => "string",
                "event_type" => "custom",
                "key" => "loaded_new_app",
                "name" => "Loaded New App"
        ));
        
        $result = $eventsService->updateCustomEvent(0, 0, $event);
        $updatedEvent = $result->getPayload();
        
        $this->assertTrue($updatedEvent instanceOf CustomEvent);
        $this->assertTrue($updatedEvent->getName()=='Loaded New App');                
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
        
        // Create new event in the project
        $event = new ClickEvent(array(
              "event_filter" => array(
                "filter_type" => "target_selector",
                "selector" => ".menu-options"
              ),
              "name" => "Add to Cart",
              "archived" => true,
              "category" => "add_to_cart",
              "description" => "Some simple event",
              "event_type" => "click",
              "key" => "add_to_cart",
              "created" => "2016-10-18T05:07:04.153Z",
              "id" => 0,
              "is_classic" => false,
              //"is_editable" => true,
              "page_id" => $createdPage->getId(),
              "project_id" => $createdProject->getId()
        ));
        
        $result = $optimizelyClient->events()->createClickEvent($createdPage->getId(), $event);
        $createdEvent = $result->getPayload();
        
        $this->assertTrue($createdEvent instanceOf ClickEvent);
        $this->assertTrue($createdEvent->getName()=='Add to Cart');  
        
        // List all existing events and try to find the created event
        $eventFound = false;        
        try {
            $page = 1;
            for (;;) {                            
                $result = $optimizelyClient->events()->listAll($createdProject->getId(), $page);

                $events = $result->getPayload();
                               
                foreach ($events as $event) {
                    if ($event->getName()=="Add to Cart") {
                        $eventFound = true;
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
        
        $this->assertTrue($eventFound);
        
        // Update page
        $createdEvent->setName('Add to Cart 2');
        $result = $optimizelyClient->events()->updateClickEvent($createdPage->getId(), $createdEvent->getId(), $createdEvent);
        $updatedEvent = $result->getPayload();                
        
        $this->assertTrue($updatedEvent instanceOf Event);
        $this->assertTrue($updatedEvent->getName()=='Add to Cart 2');  
        
        // Make project archived
        
        $createdProject->setStatus('archived');
        $result = $optimizelyClient->projects()->update($createdProject->getId(), $createdProject);
        $updatedProject = $result->getPayload();
        
        $this->assertEquals('archived', $updatedProject->getStatus());
    }
}

