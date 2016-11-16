<?php
namespace OptimizelyPHPTest\Service\v2;

use OptimizelyPHPTest\Service\v2\BaseServiceTest;
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Exception;
use WebMarketingROI\OptimizelyPHP\Result;
use WebMarketingROI\OptimizelyPHP\Service\v2\Projects;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Project;

class ProjectsTest extends BaseServiceTest
{
    public function testListAll()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $curDate = date('Y-m-d H:i:s');
        
        $result = new Result(array(
                        array(
                            'id' => '1523456',
                            'account_id' => '54321',
                            'name' => 'Some Optimizely Project',
                            'created' => $curDate,
                            'last_modified' => $curDate,
                            'is_classic' => true,
                            'socket_token' => 'fwerw',            
                            'web_snippet' => array(
                                "enable_force_variation" => false,
                                "exclude_disabled_experiments" => false,
                                "exclude_names" => true,
                                "include_jquery" => true,
                                "ip_anonymization" => false,
                                "ip_filter" => "^206\\.23\\.100\\.([5-9][0-9]|1([0-4][0-9]|50))$",
                                "library" => "jquery-1.11.3-trim",
                                "project_javascript" => "alert(\"Active Experiment\")",
                                "code_revision" => '123456',
                                "js_file_size" => 5004
                            )
                        )
                    ), 200);
                        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $projectsService = new Projects($optimizelyApiClientMock);
        
        $result = $projectsService->listAll();
        $projects = $result->getPayload();
        
        $this->assertTrue(count($projects)==1);
        $this->assertTrue($projects[0] instanceOf Project);
        $this->assertTrue($projects[0]->getName()=='Some Optimizely Project');        
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
        
        $projectsService = new Projects($optimizelyApiClientMock);
        
        $result = $projectsService->listAll(-1, 25);
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
        
        $projectsService = new Projects($optimizelyApiClientMock);
        
        $result = $projectsService->listAll(1, 1000);
    }
    
    public function testGet()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();
                
        $curDate = date('Y-m-d H:i:s');
        
        $result = new Result(array(
                            'id' => '1523456',
                            'account_id' => '54321',
                            'name' => 'Some Optimizely Project',
                            'created' => $curDate,
                            'last_modified' => $curDate,
                            'is_classic' => true,
                            'socket_token' => 'fwerw',            
                            'web_snippet' => array(
                                "enable_force_variation" => false,
                                "exclude_disabled_experiments" => false,
                                "exclude_names" => true,
                                "include_jquery" => true,
                                "ip_anonymization" => false,
                                "ip_filter" => "^206\\.23\\.100\\.([5-9][0-9]|1([0-4][0-9]|50))$",
                                "library" => "jquery-1.11.3-trim",
                                "project_javascript" => "alert(\"Active Experiment\")",
                                "code_revision" => '123456',
                                "js_file_size" => 5004
                            )                        
                        ), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $projectsService = new Projects($optimizelyApiClientMock);
        
        $result = $projectsService->get(1523456);
        $project = $result->getPayload();
        
        $this->assertTrue($project instanceOf Project);
        $this->assertTrue($project->getName()=='Some Optimizely Project');        
    }
    
    /**
     * @expectedException Exception
     */
    public function testGet_NegativeProjectId()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();
        
        $projectsService = new Projects($optimizelyApiClientMock);
        
        $result = $projectsService->get(-1);
    }
    
    public function testCreate()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $curDate = date('Y-m-d H:i:s');
        
        $result = new Result(array(
                            "name" => "Test Project",
                            "account_id" => 12345,
                            "confidence_threshold" => 0.9,
                            "dcp_service_id" => 121234,
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
                              "project_javascript" => "alert(\"Active Experiment\")",
                              "code_revision" => 0,
                              "js_file_size" => 63495
                            ),
                            "created" => "2016-10-17T07:04:59.991Z",
                            "id" => 1000,
                            "is_classic" => true,
                            "last_modified" => "2016-10-17T07:04:59.991Z",
                            "socket_token" => "AABBCCDD~123456789"                   
                        ), 201);
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $projectsService = new Projects($optimizelyApiClientMock);
        
        $project = new Project(array(
            "name" => "Test Project",
            "account_id" => 12345,
            "confidence_threshold" => 0.9,
            "dcp_service_id" => 121234,
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
        
        $result = $projectsService->create($project);
        $createdProject = $result->getPayload();
        
        $this->assertTrue($createdProject instanceOf Project);
        $this->assertTrue($createdProject->getName()=='Test Project');        
        $this->assertTrue($createdProject->getAccountId()==12345);        
    }
    
    /**
     * @expectedException Exception
     */
    public function testCreate_InvalidProject()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();
        
        $projectsService = new Projects($optimizelyApiClientMock);
        
        $result = $projectsService->create(1);
    }
    
    public function testUpdate()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();

        $curDate = date('Y-m-d H:i:s');
        
        $result = new Result(array(
                            "name" => "Test Project",
                            "account_id" => 12345,
                            "confidence_threshold" => 0.9,
                            "dcp_service_id" => 121234,
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
                              "project_javascript" => "alert(\"Active Experiment\")",
                              "code_revision" => 0,
                              "js_file_size" => 63495
                            ),
                            "created" => "2016-10-17T07:04:59.999Z",
                            "id" => 1000,
                            "is_classic" => true,
                            "last_modified" => "2016-10-17T07:04:59.999Z",
                            "socket_token" => "AABBCCDD~123456789"
                        ), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $projectsService = new Projects($optimizelyApiClientMock);
        
        $project = new Project(array(
            "confidence_threshold" => 0.9,
            "dcp_service_id" => 121234,
            "name" => "Test Project",
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
        
        $result = $projectsService->update(121234, $project);
        $updatedProject = $result->getPayload();
        
        $this->assertTrue($updatedProject instanceOf Project);
        $this->assertTrue($updatedProject->getName()=='Test Project');        
        $this->assertTrue($updatedProject->getAccountId()==12345);        
    }
    
    /**
     * @expectedException Exception
     */
    public function testUpdate_NegativeProjectId()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();
        
        $projectsService = new Projects($optimizelyApiClientMock);
        
        $project = new Project();
        
        $result = $projectsService->update(-1000, $project);
    }
    
    /**
     * @expectedException Exception
     */
    public function testUpdate_InvalidProject()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();
        
        $projectsService = new Projects($optimizelyApiClientMock);
        
        $result = $projectsService->update(1000, 1);
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
        
        $this->assertEquals(200, $result->getHttpCode());        
        $this->assertTrue($result->getRateLimit()>0);
        $this->assertTrue($result->getRateLimitRemaining()>0);
        $this->assertTrue($result->getRateLimitReset()>0);
        
        $createdProject = $result->getPayload();
        
        print_r($optimizelyClient->getDiagnosticsInfo());
        
        $this->assertEquals("Test Project $curDate", $createdProject->getName());
        
        // List all existing projects and try to find the created project
        $projectFound = false;
        $projectId = null;            
        try {
            $page = 1;
            for (;;) {            
                echo " = Page $page\n";
                $result = $optimizelyClient->projects()->listAll($page);

                print_r($optimizelyClient->getDiagnosticsInfo());

                $projects = $result->getPayload();

                foreach ($projects as $project) {
                    echo "Name: " . $project->getName() . "\n";
                    if ($project->getName()=="Test Project $curDate") {
                        $projectId = $project->getId();
                        $projectFound = true;
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
        
        $this->assertTrue($projectFound);
        
        // Try a non-existing project by ID - assume failure
        try {
            $result = $optimizelyClient->projects()->get(12345678);        
        } 
        catch(Exception $e) {
            //print_r($optimizelyClient->getDiagnosticsInfo());
            $this->assertEquals(Exception::CODE_API_ERROR, $e->getCode());
            $this->assertEquals('not_found', $e->getHttpCode());
            $this->assertTrue(strlen($e->getUuid())!=0);
            $this->assertTrue($e->getRateLimit()>0);
            $this->assertTrue($e->getRateLimitRemaining()>0);
            $this->assertTrue($e->getRateLimitReset()>0);
        }
        
        // Retrieve existing project by ID        
        $result = $optimizelyClient->projects()->get($projectId);        
        $project = $result->getPayload();
        
        $this->assertEquals("Test Project $curDate", $project->getName());
        
        // Make project archived
        
        $project->setStatus('archived');
        $result = $optimizelyClient->projects()->update($projectId, $project);
        $updatedProject = $result->getPayload();
        
        $this->assertEquals('archived', $updatedProject->getStatus());
    }
}


