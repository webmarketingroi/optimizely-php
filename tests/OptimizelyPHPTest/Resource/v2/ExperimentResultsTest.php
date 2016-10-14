<?php
namespace OptimizelyPHPTest\Resource\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\Resource\v2\ExperimentResults;

class ExperimentResultsTest extends PHPUnit_Framework_TestCase
{
    public function testCreateNewWithOptions()
    {
        $options = array(
            "confidence_threshold" => 0.9,
            "end_time" => "2016-10-14T05:08:43.031Z",
            "experiment_id" => 3000,
            "metrics" => array(
              array(
                "event" => "string",
                "event_name" => "string",
                "measure" => "conversions",
                "metric_id" => "string",
                "priority" => 1,
                "unit" => "session",
                "variation_results" => array(
                  "9000" => array(
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
                )
              )
            ),
            "reach" => array(
              "baseline_count" => 0,
              "baseline_reach" => 0,
              "total_count" => 0,
              "treatment_count" => 0,
              "treatment_reach" => 0,
              "variations" => array(
                "9000" => array(
                  "count" => 0,
                  "name" => "Blue Button",
                  "variation_id" => "string",
                  "variation_reach" => 0
                )
              )
            ),
            "start_time" => "2016-10-14T05:08:43.032Z"
        );
        
        $results = new ExperimentResults($options);        
        
        $this->assertEquals(0.9, $results->getConfidenceThreshold());
        $this->assertEquals('2016-10-14T05:08:43.032Z', $results->getStartTime());        
    }
    
    public function testToArray()
    {
        $options = array(
            "confidence_threshold" => 0.9,
            "end_time" => "2016-10-14T05:08:43.031Z",
            "experiment_id" => 3000,
            "metrics" => array(
              array(
                "event" => "string",
                "event_name" => "string",
                "measure" => "conversions",
                "metric_id" => "string",
                "priority" => 1,
                "unit" => "session",
                "variation_results" => array(
                  "9000" => array(
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
                )
              )
            ),
            "reach" => array(
              "baseline_count" => 0,
              "baseline_reach" => 0,
              "total_count" => 0,
              "treatment_count" => 0,
              "treatment_reach" => 0,
              "variations" => array(
                "9000" => array(
                  "count" => 0,
                  "name" => "Blue Button",
                  "variation_id" => "string",
                  "variation_reach" => 0
                )
              )
            ),
            "start_time" => "2016-10-14T05:08:43.032Z"
        );
        
        $results = new ExperimentResults($options);     
        
        $this->assertEquals($options, $results->toArray());        
    }
    
    
}



