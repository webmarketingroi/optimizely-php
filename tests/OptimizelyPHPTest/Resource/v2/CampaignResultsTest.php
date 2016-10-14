<?php
namespace OptimizelyPHPTest\Resource\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\Resource\v2\CampaignResults;

class CampaignResultsTest extends PHPUnit_Framework_TestCase
{
    public function testCreateNewWithOptions()
    {
        $options = array(
            "campaign_id" => 0,
            "confidence_threshold" => 0,
            "end_time" => "2016-10-14T05:08:42.966Z",
            "metrics" => array(
              array(
                "event" => "string",
                "event_name" => "string",
                "measure" => "conversions",
                "metric_id" => "string",
                "priority" => 0,
                "results" => array(
                  "campaign" => array(
                    "experiment_id" => 0,
                    "is_baseline" => true,
                    "lift" => array(
                      "confidence_interval" => array(
                        0.010399560300730457,
                        0.0850821459929161
                      ),
                      "is_most_conclusive" => true,
                      "is_significant" => true,
                      "significance" => 0,
                      "value" => 0,
                      "visitors_remaining" => 0
                    ),
                    "name" => "Blue Button",
                    "rate" => 0,
                    "scope" => "variation",
                    "total_increase" => array(
                      "confidence_interval" => array(
                        0.010399560300730457,
                        0.0850821459929161
                      ),
                      "is_most_conclusive" => true,
                      "is_significant" => true,
                      "significance" => 0,
                      "value" => 0,
                      "visitors_remaining" => 0
                    ),
                    "value" => 0,
                    "variation_id" => "string"
                  )
                ),
                "unit" => "session"
              )
            ),
            "start_time" => "2016-10-14T05:08:42.967Z"
        );
        
        $results = new CampaignResults($options);        
        
        $this->assertEquals(0, $results->getConfidenceThreshold());
        $this->assertEquals('2016-10-14T05:08:42.967Z', $results->getStartTime());        
    }
    
    public function testToArray()
    {
        $options = array(
            "campaign_id" => 0,
            "confidence_threshold" => 0,
            "end_time" => "2016-10-14T05:08:42.966Z",
            "metrics" => array(
              array(
                "event" => "string",
                "event_name" => "string",
                "measure" => "conversions",
                "metric_id" => "string",
                "priority" => 0,
                "results" => array(
                  "campaign" => array(
                    "experiment_id" => 0,
                    "is_baseline" => true,
                    "lift" => array(
                      "confidence_interval" => array(
                        0.010399560300730457,
                        0.0850821459929161
                      ),
                      "is_most_conclusive" => true,
                      "is_significant" => true,
                      "significance" => 0,
                      "value" => 0,
                      "visitors_remaining" => 0
                    ),
                    "name" => "Blue Button",
                    "rate" => 0,
                    "scope" => "variation",
                    "total_increase" => array(
                      "confidence_interval" => array(
                        0.010399560300730457,
                        0.0850821459929161
                      ),
                      "is_most_conclusive" => true,
                      "is_significant" => true,
                      "significance" => 0,
                      "value" => 0,
                      "visitors_remaining" => 0
                    ),
                    "value" => 0,
                    "variation_id" => "string"
                  )
                ),
                "unit" => "session"
              )
            ),
            "start_time" => "2016-10-14T05:08:42.967Z"
        );
        
        $results = new CampaignResults($options);     
        
        $this->assertEquals($options, $results->toArray());        
    }
    
    
}



