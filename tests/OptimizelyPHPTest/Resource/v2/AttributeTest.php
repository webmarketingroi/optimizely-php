<?php
namespace OptimizelyPHPTest\Resource\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Attribute;

class AttributeTest extends PHPUnit_Framework_TestCase
{
    public function testCreateNewAttribute()
    {
        $attribute = new Attribute();
        $attribute->setKey('subscriber_status');
        $attribute->setProjectId(1000);
        $attribute->setArchived(false);
        $attribute->setDescription('string');
        $attribute->setName('Subscriber Status');
        $attribute->setConditionType('custom_attribute');
        $attribute->setId(0);
        $attribute->setLastModified('2017-05-08T03:34:01.035Z');
        
        $this->assertEquals('subscriber_status', $attribute->getKey());
        $this->assertEquals(1000, $attribute->getProjectId());
        $this->assertEquals(false, $attribute->getArchived());
        $this->assertEquals('string', $attribute->getDescription());
        $this->assertEquals('Subscriber Status', $attribute->getName());
        $this->assertEquals('custom_attribute', $attribute->getConditionType());
        $this->assertEquals(0, $attribute->getId());
        $this->assertEquals('2017-05-08T03:34:01.035Z', $attribute->getLastModified());
    }
    
    public function testCreateNewAttributeWithOptions()
    {
        $options = array(
            "key" => "subscriber_status",
            "project_id" => 0,
            "archived" => false,
            "description" => "string",
            "name" => "Subscriber Status",
            "condition_type" => "custom_attribute",
            "id" => 0,
            "last_modified" => "2017-05-08T03:34:01.035Z"
        );
        
        $attribute = new Attribute($options);        
        
        $this->assertEquals('subscriber_status', $attribute->getKey());
        $this->assertEquals(0, $attribute->getProjectId());
        $this->assertEquals(false, $attribute->getArchived());
        $this->assertEquals('string', $attribute->getDescription());
        $this->assertEquals('Subscriber Status', $attribute->getName());
        $this->assertEquals('custom_attribute', $attribute->getConditionType());
        $this->assertEquals(0, $attribute->getId());
        $this->assertEquals('2017-05-08T03:34:01.035Z', $attribute->getLastModified());        
    }
    
    public function testToArray()
    {
        $options = array(
            "key" => "subscriber_status",
            "project_id" => 0,
            "archived" => false,
            "description" => "string",
            "name" => "Subscriber Status",
            "condition_type" => "custom_attribute",
            "id" => 0,
            "last_modified" => "2017-05-08T03:34:01.035Z"
        );
        
        $attribute = new Attribute($options);     
        
        $this->assertEquals($options, $attribute->toArray());        
    }
}


