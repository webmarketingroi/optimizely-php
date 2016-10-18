<?php
namespace OptimizelyPHPTest\Service\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Service\v2\Audiences;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Audience;

class AudiencesTest extends PHPUnit_Framework_TestCase
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
                            "project_id" => 1000,
                            "archived" => false,
                            "conditions" => array(
                              "and",
                              array(
                                "type" => "language",
                                "value" => "es"
                              ),
                              array(
                                "type" => "location",
                                "value" => "US-CA-SANFRANCISCO"
                              )
                            ),
                            "description" => "People that speak spanish and are in San Francisco",
                            "name" => "Spanish speaking San Franciscans",
                            "segmentation" => true,
                            "created" => "2016-10-18T05:07:04.066Z",
                            "id" => 5000,
                            "last_modified" => "2016-10-18T05:07:04.066Z"
                        )
                    ));
        
        $audiencesService = new Audiences($optimizelyApiClientMock);
        
        $audiences = $audiencesService->listAll(1000);
        
        $this->assertTrue(count($audiences)==1);
        $this->assertTrue($audiences[0] instanceOf Audience);
        $this->assertTrue($audiences[0]->getName()=='Spanish speaking San Franciscans');        
    }
    
    public function testGet()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
                            "project_id" => 1000,
                            "archived" => false,
                            "conditions" => array(
                              "and",
                              array(
                                "type" => "language",
                                "value" => "es"
                              ),
                              array(
                                "type" => "location",
                                "value" => "US-CA-SANFRANCISCO"
                              )
                            ),
                            "description" => "People that speak spanish and are in San Francisco",
                            "name" => "Spanish speaking San Franciscans",
                            "segmentation" => true,
                            "created" => "2016-10-18T05:07:04.073Z",
                            "id" => 5000,
                            "last_modified" => "2016-10-18T05:07:04.074Z"
                        ));
        
        $audiencesService = new Audiences($optimizelyApiClientMock);
        
        $audience = $audiencesService->get(5000);
        
        $this->assertTrue($audience instanceOf Audience);
        $this->assertTrue($audience->getName()=='Spanish speaking San Franciscans');        
    }
    
    public function testCreate()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
                            "project_id" => 1000,
                            "archived" => false,
                            "conditions" => array(
                              "and",
                              array(
                                "type" => "language",
                                "value" => "es"
                              ),
                              array(
                                "type" => "location",
                                "value" => "US-CA-SANFRANCISCO"
                              )
                            ),
                            "description" => "People that speak spanish and are in San Francisco",
                            "name" => "Spanish speaking San Franciscans",
                            "segmentation" => true,
                            "created" => "2016-10-18T05:07:04.083Z",
                            "id" => 5000,
                            "last_modified" => "2016-10-18T05:07:04.083Z"
                        ));
        
        $audiencesService = new Audiences($optimizelyApiClientMock);
        
        $audience = new Audience(array(
                "project_id" => 1000,
                "archived" => false,
                "conditions" => array(
                  "and",
                  array(
                    "type" => "language",
                    "value" => "es"
                  ),
                  array(
                    "type" => "location",
                    "value" => "US-CA-SANFRANCISCO"
                  )
                ),
                "description" => "People that speak spanish and are in San Francisco",
                "name" => "Spanish speaking San Franciscans",
                "segmentation" => true
        ));
        
        $createdAudience = $audiencesService->create($audience);
        
        $this->assertTrue($createdAudience instanceOf Audience);
        $this->assertTrue($createdAudience->getName()=='Spanish speaking San Franciscans');                
    }
    
    public function testUpdate()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
                            "project_id" => 1000,
                            "archived" => false,
                            "conditions" => array(
                              "and",
                              array(
                                "type" => "language",
                                "value" => "es"
                              ),
                              array(
                                "type" => "location",
                                "value" => "US-CA-SANFRANCISCO"
                              )
                            ),
                            "description" => "People that speak spanish and are in San Francisco",
                            "name" => "Spanish speaking San Franciscans",
                            "segmentation" => true,
                            "created" => "2016-10-18T05:07:04.083Z",
                            "id" => 5000,
                            "last_modified" => "2016-10-18T05:07:04.083Z"
                        ));
        
        $audiencesService = new Audiences($optimizelyApiClientMock);
        
        $audience = new Audience(array(
                "project_id" => 1000,
                "archived" => false,
                "conditions" => array(
                  "and",
                  array(
                    "type" => "language",
                    "value" => "es"
                  ),
                  array(
                    "type" => "location",
                    "value" => "US-CA-SANFRANCISCO"
                  )
                ),
                "description" => "People that speak spanish and are in San Francisco",
                "name" => "Spanish speaking San Franciscans",
                "segmentation" => true
        ));
        
        $createdAudience = $audiencesService->update(5000, $audience);
        
        $this->assertTrue($createdAudience instanceOf Audience);
        $this->assertTrue($createdAudience->getName()=='Spanish speaking San Franciscans');                
    }
}