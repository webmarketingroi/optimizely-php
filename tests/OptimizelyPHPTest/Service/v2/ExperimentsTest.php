<?php
namespace OptimizelyPHPTest\Service\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Service\v2\Experiments;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Experiment;
use WebMarketingROI\OptimizelyPHP\Resource\v2\ExperimentResults;

class ExperimentsTest extends PHPUnit_Framework_TestCase
{
    public function testListAll()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder(OptimizelyApiClient::class)
                            ->disableOriginalConstructor()
                            ->getMock();

        $curDate = date('Y-m-d H:i:s');
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
                        array(
                            "project_id" => 1000,
                            "audience_ids" => array(
                              1234,
                              1212,
                              1432
                            ),
                            "campaign_id" => 2000,
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
                                "value" => "window.someGlobalFunction();",
                                "id" => "string"
                              )
                            ),
                            "description" => "string",
                            "holdback" => 5000,
                            "key" => "home_page_experiment",
                            "metrics" => array(
                              array(
                                "kind" => "string",
                                "id" => 0
                              )
                            ),
                            "name" => "Blue Button Experiment",
                            "schedule" => array(
                              "start_time" => "2016-10-17T07:05:00.070Z",
                              "stop_time" => "2016-10-17T07:05:00.070Z",
                              "time_zone" => "UTC"
                            ),
                            "status" => "active",
                            "variations" => array(
                              array(
                                "actions" => array(
                                  array(
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
                                        "value" => "window.someGlobalFunction();",
                                        "id" => "string"
                                      )
                                    ),
                                    "page_id" => 0
                                  )
                                ),
                                "archived"=> true,
                                "key" => "blue_button_variation",
                                "name" => "Blue Button",
                                "variation_id" => 0,
                                "weight" => 0
                              )
                            ),
                            "created" => "2016-10-17T07:05:00.070Z",
                            "id" => 3000,
                            "is_classic" => false,
                            "last_modified" => "2016-10-17T07:05:00.070Z"
                          )
                        )
                    );
        
        $experimentsService = new Experiments($optimizelyApiClientMock);
        
        $experiments = $experimentsService->listAll(1000);
        
        $this->assertTrue(count($experiments)==1);
        $this->assertTrue($experiments[0] instanceOf Experiment);
        $this->assertTrue($experiments[0]->getName()=='Blue Button Experiment');        
    }
    
    public function testGet()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder(OptimizelyApiClient::class)
                            ->disableOriginalConstructor()
                            ->getMock();

        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
                            "project_id" => 1000,
                            "audience_ids" => array(
                              1234,
                              1212,
                              1432
                            ),
                            "campaign_id" => 2000,
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
                                "value" => "window.someGlobalFunction();",
                                "id" => "string"
                              )
                            ),
                            "description" => "string",
                            "holdback" => 5000,
                            "key" => "home_page_experiment",
                            "metrics" => array(
                              array(
                                "kind" => "string",
                                "id" => 0
                              )
                            ),
                            "name" => "Blue Button Experiment",
                            "schedule" => array(
                              "start_time" => "2016-10-17T07:05:00.070Z",
                              "stop_time" => "2016-10-17T07:05:00.070Z",
                              "time_zone" => "UTC"
                            ),
                            "status" => "active",
                            "variations" => array(
                              array(
                                "actions" => array(
                                  array(
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
                                        "value" => "window.someGlobalFunction();",
                                        "id" => "string"
                                      )
                                    ),
                                    "page_id" => 0
                                  )
                                ),
                                "archived"=> true,
                                "key" => "blue_button_variation",
                                "name" => "Blue Button",
                                "variation_id" => 0,
                                "weight" => 0
                              )
                            ),
                            "created" => "2016-10-17T07:05:00.070Z",
                            "id" => 3000,
                            "is_classic" => false,
                            "last_modified" => "2016-10-17T07:05:00.070Z"
                          )
                        );
        
        $experimentsService = new Experiments($optimizelyApiClientMock);
        
        $experiment = $experimentsService->get(3000);
        
        $this->assertTrue($experiment instanceOf Experiment);
        $this->assertTrue($experiment->getName()=='Blue Button Experiment');        
    }
    
    public function testGetResults()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder(OptimizelyApiClient::class)
                            ->disableOriginalConstructor()
                            ->getMock();

        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
                            "confidence_threshold" => 0.9,
                            "end_time" => "2016-10-17T07:05:00.089Z",
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
                            "start_time" => "2016-10-17T07:05:00.090Z"
                        ));
        
        $experimentsService = new Experiments($optimizelyApiClientMock);
        
        $experimentResults = $experimentsService->getResults(3000);
        
        $this->assertTrue($experimentResults instanceOf ExperimentResults);
        $this->assertTrue($experimentResults->getConfidenceThreshold()==0.9);        
    }
    
    public function testCreate()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder(OptimizelyApiClient::class)
                            ->disableOriginalConstructor()
                            ->getMock();

        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
                            "project_id" => 1000,
                            "audience_ids" => array(
                              1234,
                              1212,
                              1432
                            ),
                            "campaign_id" => 2000,
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
                                "value" => "window.someGlobalFunction();",
                                "id" => "string"
                              )
                            ),
                            "description" => "string",
                            "holdback" => 5000,
                            "key" => "home_page_experiment",
                            "metrics" => array(
                              array(
                                "kind" => "string",
                                "id" => 0
                              )
                            ),
                            "name" => "Blue Button Experiment",
                            "schedule" => array(
                              "start_time" => "2016-10-17T07:05:00.099Z",
                              "stop_time" => "2016-10-17T07:05:00.099Z",
                              "time_zone" => "UTC"
                            ),
                            "status" => "active",
                            "variations" => array(
                              array(
                                "actions" => array(
                                  array(
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
                                        "value" => "window.someGlobalFunction();",
                                        "id" => "string"
                                      )
                                    ),
                                    "page_id" => 0
                                  )
                                ),
                                "archived" => true,
                                "key" => "blue_button_variation",
                                "name" => "Blue Button",
                                "variation_id" => 0,
                                "weight" => 0
                              )
                            ),
                            "created" => "2016-10-17T07:05:00.099Z",
                            "id" => 3000,
                            "is_classic" => false,
                            "last_modified" => "2016-10-17T07:05:00.099Z"
                        ));
        
        $experimentsService = new Experiments($optimizelyApiClientMock);
        
        $experiment = new Experiment(array(
            "project_id" => 1000,
            "audience_ids" => array(
              1234,
              1212,
              1432
            ),
            "campaign_id" => 2000,
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
            "description" => "string",
            "holdback" => 5000,
            "key" => "home_page_experiment",
            "metrics" => array(
              array(
                "kind" => "string"
              )
            ),
            "name" => "Blue Button Experiment",
            "schedule" => array(
              "start_time" => "2016-10-17T07:04:59.724Z",
              "stop_time" => "2016-10-17T07:04:59.724Z",
              "time_zone" => "UTC"
            ),
            "status" => "active",
            "variations" => array(
              array(
                "actions" => array(
                  array(
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
                    "page_id" => 0
                  )
                ),
                "archived" => true,
                "key" => "blue_button_variation",
                "name" => "Blue Button",
                "variation_id" => 0,
                "weight" => 0
              )
            )
        ));
        
        $createdExperiment = $experimentsService->create($experiment, true);
        
        $this->assertTrue($createdExperiment instanceOf Experiment);
        $this->assertTrue($createdExperiment->getName()=='Blue Button Experiment');                
    }
    
    public function testUpdate()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder(OptimizelyApiClient::class)
                            ->disableOriginalConstructor()
                            ->getMock();

        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
                        "project_id" => 1000,
                        "audience_ids" => array(
                          1234,
                          1212,
                          1432
                        ),
                        "campaign_id" => 2000,
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
                            "value" => "window.someGlobalFunction();",
                            "id" => "string"
                          )
                        ),
                        "description" => "string",
                        "holdback" => 5000,
                        "key" => "home_page_experiment",
                        "metrics" => array(
                          array(
                            "kind" => "string",
                            "id" => 0
                          )
                        ),
                        "name" => "Blue Button Experiment",
                        "schedule" => array(
                          "start_time" => "2016-10-17T07:05:00.109Z",
                          "stop_time" => "2016-10-17T07:05:00.109Z",
                          "time_zone" => "UTC"
                        ),
                        "status" => "active",
                        "variations" => array(
                          array(
                            "actions" => array(
                              array(
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
                                    "value" => "window.someGlobalFunction();",
                                    "id" => "string"
                                  )
                                ),
                                "page_id" => 0
                              )
                            ),
                            "archived" => true,
                            "key" => "blue_button_variation",
                            "name" => "Blue Button",
                            "variation_id" => 0,
                            "weight" => 0
                          )
                        ),
                        "created" => "2016-10-17T07:05:00.109Z",
                        "id" => 3000,
                        "is_classic" => false,
                        "last_modified" => "2016-10-17T07:05:00.109Z"
                        ));
        
        $experimentsService = new Experiments($optimizelyApiClientMock);
        
        $experiment = new Experiment(array(
              "audience_ids" => array(
                0
              ),
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
              "description" => "AB Test to see if the Blue Button converts more visitors",
              "holdback" => 0,
              "key" => "home_page_experiment",
              "metrics" => array(
                array(
                  "kind" => "string"
                )
              ),
              "name" => "Blue Button Experiment",
              "schedule" => array(
                "start_time" => "2016-10-17T07:04:59.731Z",
                "stop_time" => "2016-10-17T07:04:59.731Z",
                "time_zone" => "UTC"
              ),
              "status" => "active",
              "variations" => array(
                array(
                  "actions" => array(
                    array(
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
                      "page_id" => 0
                    )
                  ),
                  "archived" => true,
                  "key" => "blue_button_variation",
                  "name" => "Blue Button",
                  "variation_id" => 0,
                  "weight" => 0
                )
              )
        ));
        
        $updatedExperiment = $experimentsService->update(1000, $experiment, true, true);
        
        $this->assertTrue($updatedExperiment instanceOf Experiment);
        $this->assertTrue($updatedExperiment->getName()=='Blue Button Experiment');                
    }
    
    public function testDelete()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder(OptimizelyApiClient::class)
                            ->disableOriginalConstructor()
                            ->getMock();

        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(                        
                        ));
        
        $experimentsService = new Experiments($optimizelyApiClientMock);
     
        $experimentsService->delete(1000);
    }
}
