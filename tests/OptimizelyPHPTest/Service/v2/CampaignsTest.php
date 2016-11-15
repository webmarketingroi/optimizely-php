<?php
namespace OptimizelyPHPTest\Service\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Result;
use WebMarketingROI\OptimizelyPHP\Service\v2\Campaigns;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Campaign;
use WebMarketingROI\OptimizelyPHP\Resource\v2\CampaignResults;

class CampaignsTest extends PHPUnit_Framework_TestCase
{
    public function testListAll()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
                        array(
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
                                "value" => "window.someGlobalFunction();",
                                "id" => "string"
                              )
                            ),
                            "created" => "2016-10-18T03:27:04.123Z",
                            "earliest" => "2016-10-18T03:27:04.123Z",
                            "experiment_ids" => array(
                              0
                            ),
                            "holdback" => 0,
                            "last_modified" => "2016-10-18T03:27:04.123Z",
                            "latest" => "2016-10-18T03:27:04.123Z",
                            "metrics" => array(
                              array(
                                "kind" => "string",
                                "id" => 0
                              )
                            ),
                            "name" => "Landing Page Optimization",
                            "page_ids" => array(
                              0
                            ),
                            "status" => "active",
                            "type" => "a/b",
                            "id" => 2000
                          )
                        ), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $campaignsService = new Campaigns($optimizelyApiClientMock);
        
        $result = $campaignsService->listAll(1000);
        $campaigns = $result->getPayload();
        
        $this->assertTrue(count($campaigns)==1);
        $this->assertTrue($campaigns[0] instanceOf Campaign);
        $this->assertTrue($campaigns[0]->getName()=='Landing Page Optimization');        
    }
    
    public function testGet()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
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
                                "value" => "window.someGlobalFunction();",
                                "id" => "string"
                              )
                            ),
                            "created" => "2016-10-18T03:27:04.139Z",
                            "earliest" => "2016-10-18T03:27:04.139Z",
                            "experiment_ids" => array(
                              0
                            ),
                            "holdback" => 0,
                            "last_modified" => "2016-10-18T03:27:04.139Z",
                            "latest" => "2016-10-18T03:27:04.139Z",
                            "metrics" => array(
                              array(
                                "kind" => "string",
                                "id" => 0
                              )
                            ),
                            "name" => "Landing Page Optimization",
                            "page_ids" => array(
                              0
                            ),
                            "status" => "active",
                            "type" => "a/b",
                            "id" => 2000   
                        ), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $campaignsService = new Campaigns($optimizelyApiClientMock);
        
        $result = $campaignsService->get(2000);
        $campaign = $result->getPayload();
        
        $this->assertTrue($campaign instanceOf Campaign);
        $this->assertTrue($campaign->getName()=='Landing Page Optimization');        
    }
    
    public function testGetResults()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
                            "campaign_id" => 0,
                            "confidence_threshold" => 0,
                            "end_time" => "2016-10-18T03:27:04.147Z",
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
                            "start_time" => "2016-10-18T03:27:04.148Z"
                        ), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $campaignsService = new Campaigns($optimizelyApiClientMock);
        
        $result = $campaignsService->getResults(3000);
        $campaignResults = $result->getPayload();
        
        $this->assertTrue($campaignResults instanceOf CampaignResults);
        $this->assertTrue($campaignResults->getConfidenceThreshold()==0);        
        $this->assertTrue($campaignResults->getStartTime()=="2016-10-18T03:27:04.148Z");        
    }
    
    public function testCreate()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
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
                                "value" => "window.someGlobalFunction();",
                                "id" => "string"
                              )
                            ),
                            "created" => "2016-10-18T03:27:04.155Z",
                            "earliest" => "2016-10-18T03:27:04.155Z",
                            "experiment_ids" => array(
                              0
                            ),
                            "holdback" => 0,
                            "last_modified" => "2016-10-18T03:27:04.155Z",
                            "latest" => "2016-10-18T03:27:04.155Z",
                            "metrics" => array(
                              array(
                                "kind" => "string",
                                "id" => 0
                              )
                            ),
                            "name" => "Landing Page Optimization",
                            "page_ids" => array(
                              0
                            ),
                            "status" => "active",
                            "type" => "a/b",
                            "id" => 2000
                        ), 201);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $campaignsService = new Campaigns($optimizelyApiClientMock);
        
        $campaign = new Campaign(array(
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
                "created" => "2016-10-18T03:27:04.067Z",
                "earliest" => "2016-10-18T03:27:04.067Z",
                "experiment_ids" => array(
                  0
                ),
                "holdback" => 0,
                "last_modified" => "2016-10-18T03:27:04.067Z",
                "latest" => "2016-10-18T03:27:04.067Z",
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
        ));
        
        $result = $campaignsService->create($campaign);
        $createdCampaign = $result->getPayload();
        
        $this->assertTrue($createdCampaign instanceOf Campaign);
        $this->assertTrue($createdCampaign->getName()=='Landing Page Optimization');                
    }
    
    public function testUpdate()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
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
                                "value" => "window.someGlobalFunction();",
                                "id" => "string"
                              )
                            ),
                            "created" => "2016-10-18T03:27:04.155Z",
                            "earliest" => "2016-10-18T03:27:04.155Z",
                            "experiment_ids" => array(
                              0
                            ),
                            "holdback" => 0,
                            "last_modified" => "2016-10-18T03:27:04.155Z",
                            "latest" => "2016-10-18T03:27:04.155Z",
                            "metrics" => array(
                              array(
                                "kind" => "string",
                                "id" => 0
                              )
                            ),
                            "name" => "Landing Page Optimization",
                            "page_ids" => array(
                              0
                            ),
                            "status" => "active",
                            "type" => "a/b",
                            "id" => 2000
                        ), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $campaignsService = new Campaigns($optimizelyApiClientMock);
        
        $campaign = new Campaign(array(
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
                "created" => "2016-10-18T03:27:04.067Z",
                "earliest" => "2016-10-18T03:27:04.067Z",
                "experiment_ids" => array(
                  0
                ),
                "holdback" => 0,
                "last_modified" => "2016-10-18T03:27:04.067Z",
                "latest" => "2016-10-18T03:27:04.067Z",
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
        ));
        
        $result = $campaignsService->update(2000, $campaign);
        $updatedCampaign = $result->getPayload();
                 
        $this->assertTrue($updatedCampaign instanceOf Campaign);
        $this->assertTrue($updatedCampaign->getName()=='Landing Page Optimization');                
    }
    
    public function testDelete()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $campaignsService = new Campaigns($optimizelyApiClientMock);
     
        $result = $campaignsService->delete(1000);
        
        $this->assertEquals(200, $result->getHttpCode());
        $this->assertEquals(null, $result->getPayload());
    }
}