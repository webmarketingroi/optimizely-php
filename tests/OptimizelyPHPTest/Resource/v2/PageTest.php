<?php
namespace OptimizelyPHPTest\Resource\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Page;

class PageTest extends PHPUnit_Framework_TestCase
{
    public function testCreateNewPage()
    {
        $page = new Page();
        $page->setEditUrl('https://www.optimizely.com');
        $page->setName('Home Page');
        $page->setProjectId(1000);
        $page->setActivationCode('string');
        $page->setActivationType('immediate');
        $page->setArchived(false);
        $page->setCategory('article');
        $page->setConditions('string');
        $page->setKey('home_page');
        $page->setPageType('single_url');
        $page->setCreated('2016-10-14T05:08:43.122Z');
        $page->setId(4000);
        $page->setLastModified('2016-10-14T05:08:43.122Z');
        
        $this->assertEquals('https://www.optimizely.com', $page->getEditUrl());        
        $this->assertEquals('Home Page', $page->getName());
        $this->assertEquals(1000, $page->getProjectId());
        $this->assertEquals('string', $page->getActivationCode());
        $this->assertEquals('immediate', $page->getActivationType());
        $this->assertEquals(false, $page->getArchived());
    }
    
    public function testCreateNewPageWithOptions()
    {
        $options = array(
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
            "created" => "2016-10-14T05:08:43.122Z",
            "id" => 4000,
            "last_modified" => "2016-10-14T05:08:43.122Z"
        );
        
        $page = new Page($options);        
        
        $this->assertEquals('https://www.optimizely.com', $page->getEditUrl());        
        $this->assertEquals('Home Page', $page->getName());
        $this->assertEquals(1000, $page->getProjectId());
        $this->assertEquals('string', $page->getActivationCode());
        $this->assertEquals('immediate', $page->getActivationType());
        $this->assertEquals(false, $page->getArchived());
    }
    
    public function testToArray()
    {
        $options = array(
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
            "created" => "2016-10-14T05:08:43.122Z",
            "id" => 4000,
            "last_modified" => "2016-10-14T05:08:43.122Z"
        );
        
        $page = new Page($options);     
        
        $this->assertEquals($options, $page->toArray());        
    }
    
    
}


