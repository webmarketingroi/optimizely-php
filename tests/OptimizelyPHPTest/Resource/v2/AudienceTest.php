<?php
namespace OptimizelyPHPTest\Resource\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Audience;

class AudienceTest extends PHPUnit_Framework_TestCase
{
    public function testCreateNewAudience()
    {
        $audience = new Audience();
        $audience->setProjectId(1000);
        $audience->setArchived(false);
        $audience->setConditions(array(
            "and",
            array(
              "value" => "es",
              "type" => "language"
            ),
            array(
              "value" => "US-CA-SANFRANCISCO",
              "type" => "location"
            )
        ));
        $audience->setDescription('People that speak spanish and are in San Francisco');
        $audience->setName('Spanish speaking San Franciscans');
        $audience->setSegmentation(true);
        $audience->setCreated('2016-10-14T05:08:42.822Z');
        $audience->setLastModified('2016-10-14T05:08:42.823Z');
        $audience->setId(123);
        
        $this->assertEquals(1000, $audience->getProjectId());
        $this->assertEquals(false, $audience->getArchived());
        $this->assertTrue(is_array($audience->getConditions()));
        $this->assertEquals('People that speak spanish and are in San Francisco', $audience->getDescription());
        $this->assertEquals('Spanish speaking San Franciscans', $audience->getName());
        $this->assertEquals(true, $audience->getSegmentation());
        $this->assertEquals('2016-10-14T05:08:42.822Z', $audience->getCreated());
        $this->assertEquals('2016-10-14T05:08:42.823Z', $audience->getLastModified());
        $this->assertEquals(123, $audience->getId());
    }
    
    public function testCreateNewAudienceWithOptions()
    {
        $options = array(
            "project_id" => 1000,
            "archived" => false,
            "conditions" => array(
              "and",
              array(
                "value" => "es",
                "type" => "language"
              ),
              array(
                "value" => "US-CA-SANFRANCISCO",
                "type" => "location"
              )
            ),
            "description" => "People that speak spanish and are in San Francisco",
            "name" => "Spanish speaking San Franciscans",
            "segmentation" => true
        );
        
        $audience = new Audience($options);        
        
        $this->assertEquals(1000, $audience->getProjectId());
        $this->assertEquals(false, $audience->getArchived());
        $this->assertTrue(is_array($audience->getConditions()));
        $this->assertEquals('People that speak spanish and are in San Francisco', $audience->getDescription());
        $this->assertEquals('Spanish speaking San Franciscans', $audience->getName());
        $this->assertEquals(true, $audience->getSegmentation());
    }
    
    public function testToArray()
    {
        $options = array(
            "project_id" => 1000,
            "archived" => false,
            "conditions" => array(
              "and",
              array(
                "value" => "es",
                "type" => "language"
              ),
              array(
                "value" => "US-CA-SANFRANCISCO",
                "type" => "location"
              )
            ),
            "description" => "People that speak spanish and are in San Francisco",
            "name" => "Spanish speaking San Franciscans",
            "segmentation" => true
        );
        
        $audience = new Audience($options);     
        
        $this->assertEquals($options, $audience->toArray());        
    }
}

