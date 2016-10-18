<?php
namespace OptimizelyPHPTest\Service\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Service\v2\Events;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Event;
use WebMarketingROI\OptimizelyPHP\Resource\v2\ClickEvent;
use WebMarketingROI\OptimizelyPHP\Resource\v2\CustomEvent;

class EventsTest extends PHPUnit_Framework_TestCase
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
                    ));
        
        $eventsService = new Events($optimizelyApiClientMock);
        
        $events = $eventsService->listAll(1000, true);
        
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

        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
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
                        ));
        
        $eventsService = new Events($optimizelyApiClientMock);
        
        $event = $eventsService->get(5000);
        
        $this->assertTrue($event instanceOf Event);
        $this->assertTrue($event->getName()=='Add to Cart');        
    }
    
    public function testCreateClickEvent()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
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
                        ));
        
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
        
        $createdEvent = $eventsService->createClickEvent(0, $event);
        
        $this->assertTrue($createdEvent instanceOf ClickEvent);
        $this->assertTrue($createdEvent->getName()=='Add to Cart');                
    }
    
    public function testCreateCustomEvent()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
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
                        ));
        
        $eventsService = new Events($optimizelyApiClientMock);
        
        $event = new CustomEvent(array(
                "archived" => true,
                "category" => "add_to_cart",
                "description" => "string",
                "event_type" => "custom",
                "key" => "loaded_new_app",
                "name" => "Loaded New App"
        ));
        
        $createdEvent = $eventsService->createCustomEvent(0, $event);
        
        $this->assertTrue($createdEvent instanceOf CustomEvent);
        $this->assertTrue($createdEvent->getName()=='Loaded New App');                
    }
    
    public function testUpdateClickEvent()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
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
                        ));
        
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
        
        $updatedEvent = $eventsService->updateClickEvent(0, 0, $event);
        
        $this->assertTrue($updatedEvent instanceOf ClickEvent);
        $this->assertTrue($updatedEvent->getName()=='Add to Cart');                
    }
    
    public function testUpdateCustomEvent()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
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
                        ));
        
        $eventsService = new Events($optimizelyApiClientMock);
        
        $event = new CustomEvent(array(
                "archived" => true,
                "category" => "add_to_cart",
                "description" => "string",
                "event_type" => "custom",
                "key" => "loaded_new_app",
                "name" => "Loaded New App"
        ));
        
        $updatedEvent = $eventsService->updateCustomEvent(0, 0, $event);
        
        $this->assertTrue($updatedEvent instanceOf CustomEvent);
        $this->assertTrue($updatedEvent->getName()=='Loaded New App');                
    }
}

