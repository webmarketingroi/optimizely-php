<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 12 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;

/**
 * Optimizely event filter.
 */
class EventFilter
{
    /**
     * Can be 'target_selector'
     * @var string
     */
    private $filterType;
    
    /**
     *
     * @var string
     */
    private $selector;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'filter_type': $this->setFilterType($value); break;
                case 'selector': $this->setSelector($value); break;
                default:
                    throw new Exception('Unknown option found in the EventFilter entity: ' . $name);
            }
        }
    }
    
    /**
     * Returns this object as array.
     */
    public function toArray()
    {
        $options = array(
            'filter_type' => $this->getFilterType(),
            'selector' => $this->getSelector(),            
        );
        
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
    }
    
    public function getFilterType()
    {
        return $this->filterType;
    }
    
    public function setFilterType($filterType)
    {
        $this->filterType = $filterType;
    }
    
    public function getSelector()
    {
        return $this->selector;
    }
    
    public function setSelector($selector)
    {
        $this->selector = $selector;
    }
}












