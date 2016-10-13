<?php
namespace OptimizelyPHPTest\Service\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;

class ProjectsTest extends PHPUnit_Framework_TestCase
{
    public function testListAll()
    {
        $apiKey = getenv('OPTIMIZELY_PHP_API_KEY');
        $client = new OptimizelyApiClient($apiKey);
        
        $projects = $client->projects()->listAll();
        
        $this->assertTrue(count($projects)!=0);
        foreach ($projects as $project) {
            $this->assertTrue($project instanceOf \WebMarketingROI\OptimizelyPHP\Resource\v2\Project);
            $this->assertTrue(strlen($project->getName())!=0);
        }
    }
}
