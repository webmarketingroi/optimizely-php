<?php
namespace OptimizelyPHPTest\Resource\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Experiment;

class ExperimentTest extends PHPUnit_Framework_TestCase
{
    public function testCreateNewExperiment()
    {
        $experiment = new Experiment();
        $experiment->setProjectId('152345');
        $experiment->setName('Test Project');
        $curDate = date('Y-m-d H:i:s');
        $experiment->setCreated($curDate);
        
        $this->assertEquals('152345', $experiment->getProjectId());
        $this->assertEquals('Test Project', $experiment->getName());
        $this->assertEquals($curDate, $experiment->getCreated());
    }
    
    public function testCreateNewExperimentWithOptions()
    {
        $curDate = date('Y-m-d H:i:s');
        
        $options = array(
            'project_id' => '152345',
            'name' => 'Test Project',
            'created' => $curDate
        );
        
        $experiment = new Experiment($options);        
        
        $this->assertEquals('152345', $experiment->getProjectId());
        $this->assertEquals('Test Project', $experiment->getName());
        $this->assertEquals($curDate, $experiment->getCreated());
    }
}
