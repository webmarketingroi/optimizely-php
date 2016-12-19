<?php
namespace OptimizelyPHPTest\Resource\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Project;
use WebMarketingROI\OptimizelyPHP\Resource\v2\WebSnippet;

class ProjectTest extends PHPUnit_Framework_TestCase
{
    public function testCreateNewProject()
    {
        $project = new Project();
        $project->setId('123456');
        $project->setAccountId('54321');
        $project->setName('Some Optimizely Project');
        $curDate = date('Y-m-d H:i:s');
        $project->setCreated($curDate);
        $project->setLastModified($curDate);
        $project->setConfidenceThreshold(0.9);
        $project->setDcpServiceId('52425');
        $project->setPlatform('web');
        $project->setSdks(['android']);
        $project->setStatus('active');
        $project->setIsClassic(true);
        $project->setSocketToken('fwerwr');
        
        $webSnippet = new WebSnippet();
        $webSnippet->setEnableForceVariation(false);
        $webSnippet->setExcludeDisabledExperiments(true);
        $webSnippet->setExcludeNames(true);
        $webSnippet->setIncludeJquery(true);
        $webSnippet->setIpAnonymization(false);
        $webSnippet->setIpFilter('^206\\.23\\.100\\.([5-9][0-9]|1([0-4][0-9]|50))$');
        $webSnippet->setLibrary('jquery-1.11.3-trim');
        $webSnippet->setProjectJavascript("alert(\"Active Experiment\")");
        $webSnippet->setCodeRevision('12367');
        $webSnippet->setJsFileSize(5004);
        
        $project->setWebSnippet($webSnippet);
        
        $this->assertEquals('123456', $project->getId());
        $this->assertEquals('54321', $project->getAccountId());
        $this->assertEquals('Some Optimizely Project', $project->getName());
        $this->assertEquals($curDate, $project->getCreated());
        $this->assertEquals($curDate, $project->getLastModified());
        $this->assertEquals(0.9, $project->getConfidenceThreshold());
        $this->assertEquals('52425', $project->getDcpServiceId());
        $this->assertEquals('web', $project->getPlatform());
        $this->assertEquals(['android'], $project->getSdks());
        $this->assertEquals('active', $project->getStatus());
        $this->assertEquals(true, $project->getIsClassic());
        $this->assertEquals('fwerwr', $project->getSocketToken());
        $this->assertEquals(false, $project->getWebSnippet()->getEnableForceVariation());
        $this->assertEquals(true, $project->getWebSnippet()->getExcludeDisabledExperiments());
        $this->assertEquals('^206\\.23\\.100\\.([5-9][0-9]|1([0-4][0-9]|50))$', $project->getWebSnippet()->getIpFilter());
        $this->assertEquals(false, $project->getWebSnippet()->getIpAnonymization());
        $this->assertEquals(true, $project->getWebSnippet()->getIncludeJquery());
        $this->assertEquals('jquery-1.11.3-trim', $project->getWebSnippet()->getLibrary());
        $this->assertEquals("alert(\"Active Experiment\")", $project->getWebSnippet()->getProjectJavascript());
        $this->assertEquals('12367', $project->getWebSnippet()->getCodeRevision());
        $this->assertEquals(5004, $project->getWebSnippet()->getJsFileSize());
        $this->assertEquals(true, $project->getWebSnippet()->getExcludeNames());
    }
    
    public function testCreateNewProjectWithOptions()
    {
        $curDate = date('Y-m-d H:i:s');
        
        $options = array(
            'id' => '1523456',
            'account_id' => '54321',
            'name' => 'Some Optimizely Project',
            'platform' => 'web',
            'sdks' => ['php'],
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
        );
        
        $project = new Project($options);        
        
        $this->assertEquals('1523456', $project->getId());
        $this->assertEquals('54321', $project->getAccountId());
        $this->assertEquals('Some Optimizely Project', $project->getName());
        $this->assertEquals($curDate, $project->getCreated());
        $this->assertEquals($curDate, $project->getLastModified());
        $this->assertEquals(true, $project->getIsClassic());
        $this->assertEquals('fwerw', $project->getSocketToken());
        $this->assertEquals(false, $project->getWebSnippet()->getExcludeDisabledExperiments());
        $this->assertEquals('^206\\.23\\.100\\.([5-9][0-9]|1([0-4][0-9]|50))$', $project->getWebSnippet()->getIpFilter());
    }
    
    public function testToArray()
    {
        $curDate = date('Y-m-d H:i:s');
        
        $options = array(
            'id' => '1523456',
            'account_id' => '54321',
            'name' => 'Some Optimizely Project',
            'created' => $curDate,
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
        );
        
        $project = new Project($options);        
        
        $this->assertEquals($options, $project->toArray());        
    }
}
