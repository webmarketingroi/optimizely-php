<?php
namespace OptimizelyPHPTest\Service\v2;

use OptimizelyPHPTest\Service\v2\BaseServiceTest;
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Exception;
use WebMarketingROI\OptimizelyPHP\Result;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Plan as PlanResource;
use WebMarketingROI\OptimizelyPHP\Service\v2\Plan;

class PlanTest extends BaseServiceTest
{
    public function testGet()
    {
        // Mock 'OptimizelyApiClient' object to avoid real API calls
        $optimizelyApiClientMock = $this->getMockBuilder('\WebMarketingROI\OptimizelyPHP\OptimizelyApiClient')
                            ->disableOriginalConstructor()
                            ->getMock();
                
        $result = new Result(array(
                            'account_id' => '54321',
                            'plan_name' => 'premium',
                            'status' => 'active',
                            'unit_of_measurement' => 'Impressions',
                            'product_usages' => array(
                                array(
                                    'allocation_term_in_months' => 6,
                                    'end_time' => '2019-12-31',
                                    'last_update_time' => '2019-06-01',
                                    'overage_cents_per_visitor' => 50,
                                    'product_name' => 'Product Name',
                                    'projects' => array(12345 => 10),
                                    'start_time' => '2019-06-01',
                                    'usage' => 1,
                                    'usage_allowance' => 5,
                                ),
                            ),                     
                        ), 200);
        
        $optimizelyApiClientMock->method('sendApiRequest')
                    ->willReturn($result);
        
        $planService = new Plan($optimizelyApiClientMock);
        
        $result = $planService->get();
        $plan = $result->getPayload();
        
        $this->assertTrue($plan instanceof PlanResource);
        $this->assertTrue($plan->getPlanName()=='premium');        
    }
    
    public function testIntegration()
    {
        if (!getenv('OPTIMIZELY_PHP_TEST_INTEGRATION')) 
            $this->markTestSkipped('OPTIMIZELY_PHP_TEST_INTEGRATION env var is not set');
        
        $credentials = $this->loadCredentialsFromFile();
        
        $optimizelyClient = new OptimizelyApiClient($credentials, 'v2');
        $this->assertTrue($optimizelyClient!=null);
       
        // Retrieve plan        
        $result = $optimizelyClient->plan()->get();        
        $plan = $result->getPayload();
        
        $this->assertTrue($plan instanceof PlanResource);
    }
}


