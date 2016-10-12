<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 12 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

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
                case 'actions': $this->setActions($value); break;
                case 'archived': $this->setArchived($value); break;
                case 'name': $this->setName($value); break;
                case 'variation_id': $this->setVariationId($value); break;
                case 'weight': $this->setWeight($value); break;
                default:
                    throw new \Exception('Unknown option: ' . $name);
            }
        }
    }
    
    /**
     * Returns this object as array.
     */
    public function toArray()
    {
        return array(
            'actions' => $this->actions,
            'archived' => $this->archived,
            'name' => $this->name,
            'variation_id' => $this->variationId,
            'weight' => $this->weight
        );
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









