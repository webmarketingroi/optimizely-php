<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 16 July 2019
 * @copyright (c) 2019, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;

/**
 * An Optimizely product usage.
 */
class ProductUsage
{
    /**
     * The current allocation term length in months.  
     * @var integer
     */
    private $allocationTermInMonths;
    
    /**
     * The end date of the current allocation term period.
     * @var string
     */
    private $endTime;
    
    /**
     * The last time that the unit_of_measurement count was updated
     * @var string
     */
    private $lastUpdateTime;
    
    /**
     * (optional) The cost in cents for every visitor when the number of 
     * unit_of_measurement has exceeded the usage_allowance. This value is 
     * only set for accounts with a limited usage_allowance
     * @var number 
     */
    private $overageCentsPerVisitor;
    
    /**
     * The product name
     * @var string
     */
    private $productName;
    
    /**
     * Key-value map of usage per project under this account and this product. 
     * Keys are project IDs, values are usage numbers. Only available for the 
     * Impressions metrics, otherwise omitted.
     * @var array 
     */
    private $projects;
    
    /**
     * The start date of the current allocation term period. For monthly paying 
     * accounts, the current allocation term period means the current billing month
     * @var string 
     */
    private $startTime;
    
    /**
     * The total usage in the unit_of_measurement within the current allocation term
     * @var integer 
     */
    private $usage;
    
    /**
     * (optional) The total usage allowed in the unit_of_measurement for the 
     * current allocation term. This value is only set for accounts with a 
     * limited usage_allowance
     * 
     * @var integer 
     */
    private $usageAllowance;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'allocation_term_in_months': $this->setAllocationTermInMonths($value); break;
                case 'end_time': $this->setEndTime($value); break;
                case 'last_update_time': $this->setLastUpdateTime($value); break;
                case 'overage_cents_per_visitor': $this->setOverageCentsPerVisitor($value); break;
                case 'product_name': $this->setProductName($value); break;
                case 'projects': $this->setProjects($value); break;
                case 'start_time': $this->setStartTime($value); break;
                case 'usage': $this->setUsage($value); break;
                case 'usage_allowance': $this->setUsageAllowance($value); break;
                default:
                    throw new Exception('Unknown option found in the ProductUsage entity: ' . $name);
            }
        }
    }
    
    /**
     * Returns this object as array.
     */
    public function toArray()
    {
        $options = array(
            'allocation_term_in_months' => $this->getAllocationTermInMonths(),
            'end_time' => $this->getEndTime(),
            'last_update_time' => $this->getLastUpdateTime(),
            'overage_cents_per_visitor' => $this->getOverageCentsPerVisitor(),
            'product_name' => $this->getProductName(),
            'projects' => $this->getProjects(),
            'start_time' => $this->getStartTime(),
            'usage' => $this->getUsage(),
            'usage_allowance' => $this->getUsageAllowance(),
        );
                
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
    }
    
    public function getAllocationTermInMonths()
    {
        return $this->allocationTermInMonths;
    }
    
    public function setAllocationTermInMonths($allocationTermInMonths)
    {
        $this->allocationTermInMonths = $allocationTermInMonths;
    }
    
    public function getEndTime()
    {
        return $this->endTime;
    }
    
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }
    
    public function getLastUpdateTime()
    {
        return $this->lastUpdateTime;
    }
    
    public function setLastUpdateTime($lastUpdateTime)
    {
        $this->lastUpdateTime = $lastUpdateTime;
    }
    
    public function getOverageCentsPerVisitor()
    {
        return $this->overageCentsPerVisitor;
    }
    
    public function setOverageCentsPerVisitor($overageCentsPerVisitor)
    {
        $this->overageCentsPerVisitor = $overageCentsPerVisitor;
    }
    
    public function getProductName()
    {
        return $this->productName;
    }
    
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }
    
    public function getProjects()
    {
        return $this->projects;
    }
    
    public function setProjects($projects)
    {
        $this->projects = $projects;
    }
    
    public function getStartTime()
    {
        return $this->startTime;
    }
    
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }
    
    public function getUsage()
    {
        return $this->usage;
    }
    
    public function setUsage($usage)
    {
        $this->usage = $usage;
    }
    
    public function getUsageAllowance()
    {
        return $this->usageAllowance;
    }
    
    public function setUsageAllowance($usageAllowance)
    {
        $this->usageAllowance = $usageAllowance;
    }
}









