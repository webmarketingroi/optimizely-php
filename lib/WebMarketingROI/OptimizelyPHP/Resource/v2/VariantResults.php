<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 12 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Datapoint;

/**
 * Optimizely campaign variant results.
 */
class VariantResults
{
    /**
     * The unique identifier for the Experiment this entity contains results for (if applicable).
     * @var integer 
     */
    private $experimentId;
    
    /**
     * Indicates that this variant is the baseline that all other entities will 
     * be compared against. Also referred to as the 'Control' or 'Control Group'.
     * @var boolean
     */
    private $isBaseline;
    
    /**
     * The relative difference in performance of this variant vs. the baseline 
     * variant. Lift is calculated as follows: (Winning Conversion Rate % - Old 
     * Conversion Rate %) - Old Conversion Rate % = % Improvement
     * @var Datapoint
     */
    private $lift;
    
    /**
     * The name of the variant
     * @var string
     */
    private $name;
    
    /**
     *
     * @var number
     */
    private $rate;
    
    /**
     * The scope that this variant represents. Can be 'variation', 'experiment' or 'campaign'
     * @var string 
     */
    private $scope;
    
    /**
     *
     * @var Datapoint
     */
    private $totalIncrease;
    
    /**
     *
     * @var number
     */
    private $value;
    
    /**
     * 
     * @var string 
     */
    private $variationId;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'experiment_id': $this->setExperimentId($value); break;
                case 'is_baseline': $this->setIsBaseline($value); break;
                case 'lift': $this->setLift(new Datapoint($value)); break;
                case 'name': $this->setName($value); break;
                case 'rate': $this->setRate($value); break;
                case 'scope': $this->setScope($value); break;
                case 'total_increase': $this->setTotalIncrease(new Datapoint($value)); break;
                case 'value': $this->setValue($value); break;
                case 'variation_id': $this->setVariationId($value); break;
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
            'experiment_id' => $this->getExperimentId(),
            'is_baseline' => $this->getIsBaseline(),
            'lift' => $this->getLift()?$this->getLift()->toArray():null,
            'name' => $this->getName(),
            'rate' => $this->getRate(),
            'scope' => $this->getScope(),
            'total_increase' => $this->getTotalIncrease()?$this->getTotalIncrease()->toArray():null,
            'value' => $this->getValue(),
            'variation_id' => $this->getVariationId()
        );
        
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
    }
    
    public function getExperimentId()
    {
        return $this->experimentId;
    }
    
    public function setExperimentId($experimentId)
    {
        $this->experimentId = $experimentId;
    }
    
    public function getIsBaseline()
    {
        return $this->isBaseline;
    }
    
    public function setIsBaseline($isBaseline)
    {
        $this->isBaseline = $isBaseline;
    }
    
    public function getLift()
    {
        return $this->lift;
    }
    
    public function setLift($lift)
    {
        $this->lift = $lift;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getRate()
    {
        return $this->rate;
    }
    
    public function setRate($rate)
    {
        $this->rate = $rate;
    }
    
    public function getScope()
    {
        return $this->scope;
    }
    
    public function setScope($scope)
    {
        $this->scope = $scope;
    }
    
    public function getTotalIncrease()
    {
        return $this->totalIncrease;
    }
    
    public function setTotalIncrease($totalIncrease)
    {
        $this->totalIncrease = $totalIncrease;
    }
    
    public function getValue()
    {
        return $this->value;
    }
    
    public function setValue($value)
    {
        $this->value = $value;
    }
    
    public function getVariationId()
    {
        return $this->variationId;
    }
    
    public function setVariationId($variationId)
    {
        $this->variationId = $variationId;
    }
}








