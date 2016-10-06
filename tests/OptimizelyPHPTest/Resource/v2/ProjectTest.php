<?php
namespace OptimizelyPHPTest\Resource\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Project;

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
        
        $this->assertEquals('1523456', $project->getId());
        $this->assertEquals('54321', $project->getAccountId());
        $this->assertEquals('Some Optimizely Project', $project->getName());
        $this->assertEquals($curDate, $experiment->getCreated());
    }
    
    public function testCreateNewProjectWithOptions()
    {
        $curDate = date('Y-m-d H:i:s');
        
        $options = array(
            'id' => '1523456',
            'account_id' => '54321',
            'name' => 'Some Optimizely Project',
            'created' => $curDate
        );
        
        $project = new Project($options);        
        
        $this->assertEquals('1523456', $project->getId());
        $this->assertEquals('54321', $project->getAccountId());
        $this->assertEquals('Some Optimizely Project', $project->getName());
        $this->assertEquals($curDate, $experiment->getCreated());
    }
}
