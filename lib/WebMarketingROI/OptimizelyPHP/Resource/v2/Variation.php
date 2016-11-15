<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 12 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Action;

/**
 * Optimizely variation.
 */
class Variation
{
    /**
     * A set of actions to take to apply the experiment when running
     * @var array[Actions]
     */
    private $actions;
    
    /**
     * Whether the variation is archived
     * @var boolean
     */
    private $archived;
    
    /**
     * Unique string identifier for this variation within the experiment
     * @var string
     */
    private $key;
    
    /**
     * The name of the variation
     * @var string
     */
    private $name;
    
    /**
     * The ID of the variation
     * @var type 
     */
    private $variationId;
    
    /**
     * The weight of the variation expressed as an integer between 0 and 10000. 
     * The weights of all varitions MUST add up to 10000 total (i.e. 100%)
     * @var integer 
     */
    private $weight;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'actions': {
                    $actions = array();
                    foreach ($value as $actionInfo) {
                        $actions[] = new Action($actionInfo);
                    }
                    $this->setActions($actions); break;
                }
                case 'archived': $this->setArchived($value); break;
                case 'key': $this->setKey($value); break;
                case 'name': $this->setName($value); break;
                case 'variation_id': $this->setVariationId($value); break;
                case 'weight': $this->setWeight($value); break;
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
            'actions' => array(),
            'archived' => $this->getArchived(),
            'key' => $this->getKey(),
            'name' => $this->getName(),
            'variation_id' => $this->getVariationId(),
            'weight' => $this->getWeight()
        );
        
        foreach ($this->getActions() as $action) {
            $options['actions'][] = $action->toArray();
        }
        
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
    }
    
    public function getActions()
    {
        return $this->actions;
    }
    
    public function setActions($actions)
    {
        $this->actions = $actions;
    }
    
    public function getArchived()
    {
        return $this->archived;
    }
    
    public function setArchived($archived)
    {
        $this->archived = $archived;
    }
    
    public function getKey()
    {
        return $this->key;
    }
    
    public function setKey($key)
    {
        $this->key = $key;
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
    
    public function getWeight()
    {
        return $this->weight;
    }
    
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
}









