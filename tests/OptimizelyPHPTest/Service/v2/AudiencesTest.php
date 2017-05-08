<?php
namespace OptimizelyPHPTest\Service\v2;

use OptimizelyPHPTest\Service\v2\BaseServiceTest;
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Result;
use WebMarketingROI\OptimizelyPHP\Service\v2\Audiences;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Audience;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Project;

class AudiencesTest extends BaseServiceTest
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
                            "conditions" => "\"[\"and\", {\"type\": \"language\", \"value\": \"es\"}, {\"type\": \"location\", \"value\": \"US-CA-SANFRANCISCO\"}]\"",
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
    
    public function testIntegration()
    {
        if (!getenv('OPTIMIZELY_PHP_TEST_INTEGRATION')) 
            $this->markTestSkipped('OPTIMIZELY_PHP_TEST_INTEGRATION env var is not set');
        
        $credentials = $this->loadCredentialsFromFile();
        
        $optimizelyClient = new OptimizelyApiClient($credentials, 'v2');
        $this->assertTrue($optimizelyClient!=null);
        
        // Create new project        
        $curDate = date('Y-m-d H:i:s');
        $newProject = new Project(array(
            "name" => "Test Project $curDate",
            "account_id" => 12345,
            "confidence_threshold" => 0.9,
            "platform" => "web",
            "status" => "active",
            "web_snippet" => array(
              "enable_force_variation" => false,
              "exclude_disabled_experiments" => false,
              "exclude_names" => true,
              "include_jquery" => true,
              "ip_anonymization" => false,
              "ip_filter" => "^206\\.23\\.100\\.([5-9][0-9]|1([0-4][0-9]|50))$",
              "library" => "jquery-1.11.3-trim",
              "project_javascript" => "alert(\"Active Experiment\")"
            )
        ));
        
        $result = $optimizelyClient->projects()->create($newProject);
        $createdProject = $result->getPayload();
        
        // Create new audience in the project
        $audience = new Audience(array(
            "project_id" => $createdProject->getId(),
            "archived" => false,
            "conditions" => "[\"and\", {\"type\": \"language\", \"value\": \"es\"}, {\"type\": \"location\", \"value\": \"US\"}]",
            "description" => "People that speak spanish and are in San Francisco",
            "name" => "Spanish speaking San Franciscans",
            "segmentation" => true
        ));
        
        $result = $optimizelyClient->audiences()->create($audience);
        $createdAudience = $result->getPayload();
        
        $this->assertTrue($createdAudience instanceOf Audience);
        $this->assertTrue($createdAudience->getName()=='Spanish speaking San Franciscans');  
        
        // List all existing audiences and try to find the created audience
        $audienceFound = false;        
        try {
            $page = 1;
            for (;;) {                            
                $result = $optimizelyClient->audiences()->listAll($createdProject->getId(), $page);

                $audiences = $result->getPayload();

                foreach ($audiences as $audience) {
                    if ($audience->getName()=="Spanish speaking San Franciscans") {
                        $audienceFound = true;
                        break;
                    }
                }

                if ($result->getNextPage()==null)
                    break;

                $page ++;
            }
        }
        catch (Exception $e) {
            // Handle error.
            $code = $e->getCode();
            $httpCode = $e->getHttpCode();
            $message = $e->getMessage();
            $uuid = $e->getUuid();
            echo "Exception caught: $message (code=$code http_code=$httpCode uuid=$uuid)\n";
        }
        
        $this->assertTrue($audienceFound);
        
        // Update audience
        $createdAudience->setName('Some new audience name');
        $result = $optimizelyClient->audiences()->update($createdAudience->getId(), $createdAudience);
        $updatedAudience = $result->getPayload();                
        
        $this->assertTrue($updatedAudience instanceOf Audience);
        $this->assertTrue($updatedAudience->getName()=='Some new audience name');  
        
        // Make project archived
        
        $createdProject->setStatus('archived');
        $result = $optimizelyClient->projects()->update($createdProject->getId(), $createdProject);
        $updatedProject = $result->getPayload();
        
        $this->assertEquals('archived', $updatedProject->getStatus());
    }
}

