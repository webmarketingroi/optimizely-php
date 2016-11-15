<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 12 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;

/**
 * Optimizely variation reach.
 */
class VariationReach
{
    /**
     * Total number of visitors exposed to this particular variation
     * @var integer
     */
    private $count;
    
    /**
     * The name of the variation
     * @var string
     */
    private $name;
    
    /**
     * The unique identifier for the variation
     * @var string
     */
    private $variationId;
    
    /**
     *
     * @var number
     */
    private $variationReach;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'count': $this->setCount($value); break;
                case 'name': $this->setName($value); break;
                case 'variation_id': $this->setVariationId($value); break;
                case 'variation_reach': $this->setVariationReach($value); break;
                default:
                    throw new Exception('Unknown option: ' . $name);
            }
        }
    }
    
    /**
     * Returns this object as array.
     */
    public function toArray()
    {
        $options = array(
            'count' => $this->getCount(),
            'name' => $this->getName(),
            'variation_id' => $this->getVariationId(),
            'variation_reach' => $this->getVariationReach(),            
        );
        
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
    }
    
    public function getCount()
    {
        return $this->count;
    }
    
    public function setCount($count)
    {
        $this->count = $count;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getVariationId()
    {
        return $this->variationId;
    }
    
    public function setVariationId($variationId)
    {
        $this->variationId = $variationId;
    }
    
    public function getVariationReach()
    {
        return $this->variationReach;
    }
    
    public function setVariationReach($variationReach)
    {
        $this->variationReach = $variationReach;
    }
}











