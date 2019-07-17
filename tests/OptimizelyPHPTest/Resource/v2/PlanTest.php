<?php
namespace OptimizelyPHPTest\Resource\v2;

use PHPUnit_Framework_TestCase;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Plan;
use WebMarketingROI\OptimizelyPHP\Resource\v2\ProductUsage;

class PlanTest extends PHPUnit_Framework_TestCase
{
    public function testCreateNewPlan()
    {
        $plan = new Plan();
        $plan->setAccountId('54321');
        $plan->setPlanName('premium');
        $plan->setStatus('active');
        $plan->setUnitOfMeasurement('Impressions');
        
        $productUsage = new ProductUsage();
        $productUsage->setAllocationTermInMonths(6);
        $productUsage->setEndTime('2019-12-31');
        $productUsage->setLastUpdateTime('2019-06-01');
        $productUsage->setOverageCentsPerVisitor(50);
        $productUsage->setProductName('Product Name');
        $productUsage->setProjects(['12345' => 10]);
        $productUsage->setStartTime('2019-06-01');
        $productUsage->setUsage(1);
        $productUsage->setUsageAllowance(5);
        
        $plan->setProductUsages([$productUsage]);
        
        $this->assertEquals('54321', $plan->getAccountId());
        $this->assertEquals('premium', $plan->getPlanName());
        $this->assertEquals('active', $plan->getStatus());
        $this->assertEquals('Impressions', $plan->getUnitOfMeasurement());
        $usages = $plan->getProductUsages();
        $this->assertEquals('Product Name', $usages[0]->getProductName());
        $this->assertEquals(['12345' => 10], $usages[0]->getProjects());
        
    }
    
    public function testCreateNewPlanWithOptions()
    {
        $options = array(
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
        );
        
        $plan = new Plan($options);        
        
        $this->assertEquals('54321', $plan->getAccountId());
        $this->assertEquals('premium', $plan->getPlanName());
        $this->assertEquals('active', $plan->getStatus());
        $this->assertEquals('Impressions', $plan->getUnitOfMeasurement());
        $usages = $plan->getProductUsages();
        $this->assertEquals('Product Name', $usages[0]->getProductName());
        $this->assertEquals(['12345' => 10], $usages[0]->getProjects());
    }
    
    public function testToArray()
    {
        $curDate = date('Y-m-d H:i:s');
        
        $options = array(
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
        );
        
        $plan = new Plan($options);        
        
        $this->assertEquals($options, $plan->toArray());        
    }
}

