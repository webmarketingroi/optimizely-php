<?php
namespace OptimizelyPHPTest\Service\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Result;
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

        $result = new Result(array(
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
                    ), 200);
        
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $audiencesService = new Audiences($optimizelyApiClientMock);
        
        $result = $audiencesService->listAll(1000);
        $audiences = $result->getPayload();
        
        $this->assertTrue(count($audiences)==1);
        $this->assertTrue($audiences[0] instanceOf Audience);
        $this->assertTrue($audiences[0]->getName()=='Spanish speaking San Franciscans');        
    }
    
    /**
     * @expectedException Exception
     */
    public function testListAll_InvalidPage()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();
        
        $audiencesService = new Audiences($optimizelyApiClientMock);
        
        $result = $audiencesService->listAll(1000, -1, 25);
    }
    
    /**
     * @expectedException Exception
     */
    public function testListAll_InvalidPerPage()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();
        
        $audiencesService = new Audiences($optimizelyApiClientMock);
        
        $result = $audiencesService->listAll(1000, 1, 1000);
    }
    
    public function testGet()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
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
                        ), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $audiencesService = new Audiences($optimizelyApiClientMock);
        
        $result = $audiencesService->get(5000);
        $audience = $result->getPayload();
        
        $this->assertTrue($audience instanceOf Audience);
        $this->assertTrue($audience->getName()=='Spanish speaking San Franciscans');        
    }
    
    public function testCreate()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
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
                        ), 201);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
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
        
        $result = $audiencesService->create($audience);
        $createdAudience = $result->getPayload();
        
        $this->assertTrue($createdAudience instanceOf Audience);
        $this->assertTrue($createdAudience->getName()=='Spanish speaking San Franciscans');                
    }
    
    public function testUpdate()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
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
                        ), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
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
        
        $result = $audiencesService->update(5000, $audience);
        $createdAudience = $result->getPayload();
        
        $this->assertTrue($createdAudience instanceOf Audience);
        $this->assertTrue($createdAudience->getName()=='Spanish speaking San Franciscans');                
    }
}

