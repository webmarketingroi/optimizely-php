<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 15 July 2019
 * @copyright (c) 2019, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;

/**
 * An Optimizely plan.
 */
class Plan
{
    /**
     * The account ID of the account that this Plan & Usage information is associated with
     * @var integer
     */
    private $accountId;
    
    /**
     * The name of the plan for the current account
     * @var string
     */
    private $planName;
    
    /**
     * Array of products under this account
     * @var ProductUsage[]
     */
    private $productUsages;
    
    /**
     * The status of the plan for the current account
     * @var string 
     */
    private $status;
    
    /**
     * The unit by which we measure the usage of this account
     * @var string
     */
    private $unitOfMeasurement;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'account_id': $this->setAccountId($value); break;
                case 'plan_name': $this->setPlanName($value); break;
                case 'product_usages': {
                    $productUsages = array();
                    foreach ($value as $productUsageInfo) {
                        $productUsages[] = new ProductUsage($productUsageInfo);
                    }
                    $this->setProductUsages($productUsages); break;
                }
                case 'status': $this->setStatus($value); break;
                case 'unit_of_measurement': $this->setUnitOfMeasurement($value); break;
                default:
                    throw new Exception('Unknown option found in the Plan entity: ' . $name);
            }
        }
    }
    
    /**
     * Returns this object as array.
     */
    public function toArray()
    {
        $options = array(
            'account_id' => $this->getAccountId(),
            'plan_name' => $this->getPlanName(),
            'product_usages' => array(),
            'status' => $this->getStatus(),
            'unit_of_measurement' => $this->getUnitOfMeasurement(),
        );
        
        foreach ($this->getProductUsages() as $productUsage) {
            $options['product_usages'][] = $productUsage->toArray();
        }
        
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
    }
    
    public function getAccountId()
    {
        return $this->accountId;
    }
    
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }
    
    public function getPlanName()
    {
        return $this->planName;
    }
    
    public function setPlanName($planName)
    {
        $this->planName = $planName;
    }
    
    public function getProductUsages()
    {
        return $this->productUsages;
    }
    
    public function setProductUsages($productUsages)
    {
        $this->productUsages = $productUsages;
    }
    
    public function getStatus()
    {
        return $this->status;
    }
    
    public function setStatus($status)
    {
        $this->status = $status;
    }
    
    public function getUnitOfMeasurement()
    {
        return $this->unitOfMeasurement;
    }
    
    public function setUnitOfMeasurement($unitOfMeasurement)
    {
        $this->unitOfMeasurement = $unitOfMeasurement;
    }
}









