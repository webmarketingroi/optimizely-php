<?php
namespace OptimizelyPHPTest\Service\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Service\v2\Projects;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Project;

class ProjectsTest extends PHPUnit_Framework_TestCase
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
                    ));
        
        $projectsService = new Projects($optimizelyApiClientMock);
        
        $projects = $projectsService->listAll();
        
        $this->assertTrue(count($projects)==1);
        $this->assertTrue($projects[0] instanceOf Project);
        $this->assertTrue($projects[0]->getName()=='Some Optimizely Project');        
    }
    
    public function testGet()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder(OptimizelyApiClient::class)
                            ->disableOriginalConstructor()
                            ->getMock();

        $curDate = date('Y-m-d H:i:s');
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
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
                        ));
        
        $projectsService = new Projects($optimizelyApiClientMock);
        
        $project = $projectsService->get(1523456);
        
        $this->assertTrue($project instanceOf Project);
        $this->assertTrue($project->getName()=='Some Optimizely Project');        
    }
    
    public function testCreate()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder(OptimizelyApiClient::class)
                            ->disableOriginalConstructor()
                            ->getMock();

        $curDate = date('Y-m-d H:i:s');
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
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
                        ));
        
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
        
        $createdProject = $projectsService->create($project);
        
        $this->assertTrue($createdProject instanceOf Project);
        $this->assertTrue($createdProject->getName()=='Test Project');        
        $this->assertTrue($createdProject->getAccountId()==12345);        
    }
    
    public function testUpdate()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder(OptimizelyApiClient::class)
                            ->disableOriginalConstructor()
                            ->getMock();

        $curDate = date('Y-m-d H:i:s');
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn(array(
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
                        ));
        
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
        
        $updatedProject = $projectsService->update(121234, $project);
        
        $this->assertTrue($updatedProject instanceOf Project);
        $this->assertTrue($updatedProject->getName()=='Test Project');        
        $this->assertTrue($updatedProject->getAccountId()==12345);        
    }
}
