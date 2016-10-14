<?php
namespace OptimizelyPHPTest\Resource\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Event;
use WebMarketingROI\OptimizelyPHP\Resource\v2\EventFilter;

class EventTest extends PHPUnit_Framework_TestCase
{
    public function testCreateNewEvent()
    {
        $event = new Event();
        $event->setArchived(true);
        $event->setCategory('add_to_cart');
        $event->setDescription('Item added to cart');
        
        $eventFilter = new EventFilter();
        $eventFilter->setFilterType('target_selector');
        $eventFilter->setSelector('.menu-options');
        $event->setEventFilter($eventFilter);
        
        $event->setEventType('custom');
        $event->setKey('add_to_cart');
        $event->setName('Add to Cart');
        $event->setPageId(5000);
        $event->setProjectId(1000);
        $event->setCreated('2016-10-14T05:08:43.170Z');
        $event->setId(0);
        $event->setIsClassic(false);
        $event->setIsEditable(true);
        
        $this->assertEquals(true, $event->getArchived());
        $this->assertEquals('add_to_cart', $event->getCategory());
        $this->assertEquals('target_selector', $event->getEventFilter()->getFilterType());
        $this->assertEquals('Add to Cart', $event->getName());
        $this->assertEquals(true, $event->getIsEditable());
    }
    
    public function testCreateNewEventWithOptions()
    {
        $options = array(
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
            "created" => "2016-10-14T05:08:43.170Z",
            "id" => 0,
            "is_classic" => false,
            "is_editable" => true
        );
        
        $event = new Event($options);        
        
        $this->assertEquals(true, $event->getArchived());
        $this->assertEquals('add_to_cart', $event->getCategory());
        $this->assertEquals('target_selector', $event->getEventFilter()->getFilterType());
        $this->assertEquals('Add to Cart', $event->getName());
        $this->assertEquals(true, $event->getIsEditable());        
    }
    
    public function testToArray()
    {
        $options = array(
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
            "created" => "2016-10-14T05:08:43.170Z",
            "id" => 0,
            "is_classic" => false,
            "is_editable" => true
        );
        
        $event = new Event($options);     
        
        $this->assertEquals($options, $event->toArray());        
    }
    
    
}


