<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 09 May 2017
 * @copyright (c) 2017, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;

/**
 * Optimizely InPage config.
 */
class InPageEventConfig
{    
    /**
     * CSS selector for the page element(s) that trigger an Event
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
                case 'selector': $this->setSelector($value); break;
                default:
                    throw new Exception('Unknown option found in the InPageConfig entity: ' . $name);
            }
        }
    }
    
    /**
     * Returns this object as array.
     */
    public function toArray()
    {
        $options = array(            
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
    
    public function getSelector()
    {
        return $this->selector;
    }
    
    public function setSelector($selector)
    {
        $this->selector = $selector;
    }        
}










