<?php
namespace OptimizelyPHPTest\Resource\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Campaign;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Change;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Metric;

class CampaignTest extends PHPUnit_Framework_TestCase
{
    public function testCreateNewCampaign()
    {
        $campaign = new Campaign();
        $campaign->setProjectId(1000);
        
        $change = new Change();
        $change->setType('custom_code');
        $change->setAllowAdditionalRedirect(true);
        $change->setAsync(true);
        $change->setCssSelector("a[href*=\"optimizely\"]");
        $change->setDependencies(array(24, 26));
        $change->setDestination('https://app.optimizely.com/');
        $change->setPreserveParameters(true);
        $change->setSrc(524);
        $change->setValue('window.someGlobalFunction();');
        $change->setId('string');
        $campaign->setChanges(array($change));
        
        $campaign->setCreated('2016-10-14T05:08:42.957Z');
        $campaign->setEarliest('2016-10-14T05:08:42.957Z');
        $campaign->setExperimentIds(array(0));
        $campaign->setHoldback(0);
        $campaign->setLastModified('2016-10-14T05:08:42.957Z');
        $campaign->setLatest('2016-10-14T05:08:42.957Z');
        
        $metric = new Metric();
        $metric->setKind('string');
        $metric->setId(0);
        $campaign->setMetrics(array($metric));
        
        $campaign->setName('Landing Page Optimization');
        $campaign->setPageIds(array(0));
        
        $campaign->setStatus('active');
        $campaign->setType('a/b');
        $campaign->setId(2000);
        
        $this->assertEquals(1000, $campaign->getProjectId());        
        $this->assertEquals('Landing Page Optimization', $campaign->getName());        
        $this->assertEquals(2000, $campaign->getId());        
        $metrics = $campaign->getMetrics();
        $this->assertEquals('string', $metrics[0]->getKind());      
        $changes = $campaign->getChanges();
        $this->assertEquals('window.someGlobalFunction();', $changes[0]->getValue());        
    }
    
    public function testCreateNewCampaignWithOptions()
    {
        $options = array(
            "project_id" => 1000,
            "changes" => array(
              array(
                "type" => "custom_code",
                "allow_additional_redirect" => true,
                "async" => true,
                "css_selector" => "a[href*=\"optimizely\"]",
                "dependencies" => array(
                  24,
                  26
                ),
                "destination" => "https://app.optimizely.com/",
                "extension_id" => 1234,
                "preserve_parameters" => true,
                "src" => 524,
                "value" => "window.someGlobalFunction();"
              )
            ),
            "created" => "2016-10-14T05:08:42.822Z",
            "earliest" => "2016-10-14T05:08:42.822Z",
            "experiment_ids" => array(
              0
            ),
            "holdback" => 0,
            "last_modified" => "2016-10-14T05:08:42.822Z",
            "latest" => "2016-10-14T05:08:42.822Z",
            "metrics" => array(
              array(
                "kind" => "string"
              )
            ),
            "name" => "Landing Page Optimization",
            "page_ids" => array(
              0
            ),
            "status" => "active",
            "type" => "a/b"
        );
        
        $campaign = new Campaign($options);        
        
        $this->assertEquals(1000, $campaign->getProjectId());        
        $this->assertEquals('2016-10-14T05:08:42.822Z', $campaign->getCreated());        
        $this->assertEquals('a/b', $campaign->getType());
        $metrics = $campaign->getMetrics();
        $this->assertEquals('string', $metrics[0]->getKind());
        $changes = $campaign->getChanges();
        $this->assertEquals(524, $changes[0]->getSrc());
    }
    
    public function testToArray()
    {
        $options = array(
            "project_id" => 1000,
            "changes" => array(
              array(
                "type" => "custom_code",
                "allow_additional_redirect" => true,
                "async" => true,
                "css_selector" => "a[href*=\"optimizely\"]",
                "dependencies" => array(
                  24,
                  26
                ),
                "destination" => "https://app.optimizely.com/",
                "extension_id" => 1234,
                "preserve_parameters" => true,
                "src" => 524,
                "value" => "window.someGlobalFunction();"
              )
            ),
            "created" => "2016-10-14T05:08:42.822Z",
            "earliest" => "2016-10-14T05:08:42.822Z",
            "experiment_ids" => array(
              0
            ),
            "holdback" => 0,
            "last_modified" => "2016-10-14T05:08:42.822Z",
            "latest" => "2016-10-14T05:08:42.822Z",
            "metrics" => array(
              array(
                "kind" => "string"
              )
            ),
            "name" => "Landing Page Optimization",
            "page_ids" => array(
              0
            ),
            "status" => "active",
            "type" => "a/b"
        );
        
        $campaign = new Campaign($options);     
        
        $this->assertEquals($options, $campaign->toArray());        
    }
}

