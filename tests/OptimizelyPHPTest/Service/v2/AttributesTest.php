<?php
namespace OptimizelyPHPTest\Service\v2;

use OptimizelyPHPTest\Service\v2\BaseServiceTest;
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Result;
use WebMarketingROI\OptimizelyPHP\Service\v2\Attributes;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Attribute;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Project;

class AttributesTest extends BaseServiceTest
{
    public function testListAll()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
                        array(
                            "key" => "subscriber_status",
                            "project_id" => 0,
                            "archived" => false,
                            "description" => "string",
                            "name" => "Subscriber Status",
                            "condition_type" => "custom_attribute",
                            "id" => 0,
                            "last_modified" => "2017-05-08T03:34:01.035Z"
                        )
                    ), 200);
        
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $attributesService = new Attributes($optimizelyApiClientMock);
        
        $result = $attributesService->listAll(0);
        $attributes = $result->getPayload();
        
        $this->assertTrue(count($attributes)==1);
        $this->assertTrue($attributes[0] instanceOf Attribute);
        $this->assertTrue($attributes[0]->getName()=='Subscriber Status');        
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
        
        $attributesService = new Attributes($optimizelyApiClientMock);
        
        $result = $attributesService->listAll(1000, -1, 25);
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
        
        $attributesService = new Attributes($optimizelyApiClientMock);
        
        $result = $attributesService->listAll(1000, 1, 1000);
    }
    
    public function testGet()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
                            "key" => "subscriber_status",
                            "project_id" => 0,
                            "archived" => false,
                            "description" => "string",
                            "name" => "Subscriber Status",
                            "condition_type" => "custom_attribute",
                            "id" => 0,
                            "last_modified" => "2017-05-08T03:34:01.035Z"
                        ), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $attributesService = new Attributes($optimizelyApiClientMock);
        
        $result = $attributesService->get(0);
        $attribute = $result->getPayload();
        
        $this->assertTrue($attribute instanceOf Attribute);
        $this->assertTrue($attribute->getName()=='Subscriber Status');        
    }
    
    public function testCreate()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
                            "key" => "subscriber_status",
                            "project_id" => 0,
                            "archived" => false,
                            "description" => "string",
                            "name" => "Subscriber Status",
                            "condition_type" => "custom_attribute",
                            "id" => 0,
                            "last_modified" => "2017-05-08T03:34:01.035Z"
                        ), 201);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $attributesService = new Attributes($optimizelyApiClientMock);
        
        $attribute = new Attribute(array(
                "key" => "subscriber_status",
                "project_id" => 0,
                "archived" => false,
                "description" => "string",
                "name" => "Subscriber Status",
                "condition_type" => "custom_attribute",
                "id" => 0,
                "last_modified" => "2017-05-08T03:34:01.035Z"
        ));
        
        $result = $attributesService->create($attribute);
        $createdAttribute = $result->getPayload();
        
        $this->assertTrue($createdAttribute instanceOf Attribute);
        $this->assertTrue($createdAttribute->getName()=='Subscriber Status');                
    }
    
    public function testUpdate()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $result = new Result(array(
                            "key" => "subscriber_status",
                            "project_id" => 0,
                            "archived" => false,
                            "description" => "string",
                            "name" => "Subscriber Status",
                            "condition_type" => "custom_attribute",
                            "id" => 0,
                            "last_modified" => "2017-05-08T03:34:01.035Z"
                        ), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $attributesService = new Attributes($optimizelyApiClientMock);
        
        $attribute = new Attribute(array(
                "key" => "subscriber_status",
                "project_id" => 0,
                "archived" => false,
                "description" => "string",
                "name" => "Subscriber Status",
                "condition_type" => "custom_attribute",
                "id" => 0,
                "last_modified" => "2017-05-08T03:34:01.035Z"
        ));
        
        $result = $attributesService->update(0, $attribute);
        $createdAttribute = $result->getPayload();
        
        $this->assertTrue($createdAttribute instanceOf Attribute);
        $this->assertTrue($createdAttribute->getName()=='Subscriber Status');                
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
        
        // Create new attribute in the project
        $attribute = new Attribute(array(
            "key" => "subscriber_status",
            "project_id" => $createdProject->getId(),
            "archived" => false,
            "description" => "string",
            "name" => "Subscriber Status",            
        ));
        
        $result = $optimizelyClient->attributes()->create($attribute);
        $createdAttribute = $result->getPayload();
        
        $this->assertTrue($createdAttribute instanceOf Attribute);
        $this->assertTrue($createdAttribute->getName()=='Subscriber Status');  
        
        // List all existing attributes and try to find the created attribute
        $attributeFound = false;        
        try {
            $page = 1;
            for (;;) {                            
                $result = $optimizelyClient->attributes()->listAll($createdProject->getId(), $page);

                $attributes = $result->getPayload();

                foreach ($attributes as $attribute) {
                    if ($attribute->getName()=="Subscriber Status") {
                        $attributeFound = true;
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
        
        $this->assertTrue($attributeFound);
        
        // Update attribute
        $createdAttribute->setName('Some new attribute name');
        $result = $optimizelyClient->attributes()->update($createdAttribute->getId(), $createdAttribute);
        $updatedAttribute = $result->getPayload();                
        
        $this->assertTrue($updatedAttribute instanceOf Attribute);
        $this->assertTrue($updatedAttribute->getName()=='Some new attribute name');  
        
        // Make project archived
        
        $createdProject->setStatus('archived');
        $result = $optimizelyClient->projects()->update($createdProject->getId(), $createdProject);
        $updatedProject = $result->getPayload();
        
        $this->assertEquals('archived', $updatedProject->getStatus());
    }
}

