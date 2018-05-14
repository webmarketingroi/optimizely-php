<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 14 May 2018
 * @copyright (c) 2018, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;

/**
 * Optimizely experiment results stats config.
 */
class StatsConfig
{
    /**
     * 
     * @var number 
     */
    private $confidenceLevel;
    
    /**
     * The type of test to compare the variant to baseline. Can be absolute or relative
     * @var string 
     */
    private $differenceType;
    
    /**
     * Indicates if epoch-based statistics were used
     * @var boolean 
     */
    private $epochEnabled;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'confidence_level': $this->setConfidenceLevel($value); break;
                case 'difference_type': $this->setDifferenceType($value); break;
                case 'epoch_enabled': $this->setEpochEnabled($value); break;
                default:
                    throw new Exception('Unknown option found in the StatsConfig entity: ' . $name);
            }
        }
    }
    
    /**
     * Returns this object as array.
     */
    public function toArray()
    {
        $options = array(
            'confidence_level' => $this->getConfidenceLevel(),
            'difference_type' => $this->getDifferenceType(),
            'epoch_enabled' => $this->getEpochEnabled(),
        );
        
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
    }
    
    public function getConfidenceLevel()
    {
        return $this->confidenceLevel;
    }
    
    public function setConfidenceLevel($confidenceLevel)
    {
        $this->confidenceLevel = $confidenceLevel;
    }
    
    public function getDifferenceType()
    {
        return $this->differenceType;
    }
    
    public function setDifferenceType($differenceType)
    {
        $this->differenceType = $differenceType;
    }
    
    public function getEpochEnabled()
    {
        return $this->epochEnabled;
    }
    
    public function setEpochEnabled($epochEnabled)
    {
        $this->epochEnabled = $epochEnabled;
    }
}










