<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 12 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;

/**
 * Optimizely datapoint.
 */
class Datapoint
{
    /**
     * The confidence interval measures the uncertainty around improvement. It 
     * starts out wide and shrinks as more data comes in. Significance means 
     * that the confidence interval is completely above or completely below 0. 
     * If the result is significant and positive, the confidence interval will 
     * be above 0. If the result is significant and negative, confidence interval 
     * will be below 0. If the result is inconclusive, confidence interval includes 0.
     * @var array[number]
     */
    private $confidenceInterval;
    
    /**
     * Indicates that this is the best performing variant for this metric. 
     * Also referred to as the 'Winner'
     * @var boolean 
     */
    private $isMostConclusive;
    
    /**
     * Indicates if significance is above your confidence threshold
     * @var boolean
     */
    private $isSignificant;
    
    /**
     * The likelihood that the observed difference in conversion rate is not due to chance.
     * @var number 
     */
    private $significance;
    
    /**
     * The relative improvement for this variant over the baseline variant.
     * @var number
     */
    private $value;
    
    /**
     * The number of estimated visitors remaining before result becomes statistically significant
     * @var integer 
     */
    private $visitorsRemaining;
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'confidence_interval': $this->setConfidenceInterval($value); break;
                case 'is_most_conclusive': $this->setIsMostConclusive($value); break;
                case 'is_significant': $this->setIsSignificant($value); break;
                case 'significance': $this->setSignificance($value); break;
                case 'value': $this->setValue($value); break;
                case 'visitors_remaining': $this->setVisitorsRemaining($value); break;
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
            'confidence_interval' => $this->getConfidenceInterval(),
            'is_most_conclusive' => $this->getIsMostConclusive(),
            'is_significant' => $this->getIsSignificant(),
            'significance' => $this->getSignificance(),
            'value' => $this->getValue(),            
            'visitors_remaining' => $this->getVisitorsRemaining(),            
        );
        
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
    }
    
    public function getConfidenceInterval()
    {
        return $this->confidenceInterval;
    }
    
    public function setConfidenceInterval($confidenceInterval)
    {
        $this->confidenceInterval = $confidenceInterval;
    }
    
    public function getIsMostConclusive()
    {
        return $this->isMostConclusive;
    }
    
    public function setIsMostConclusive($isMostConclusive)
    {
        $this->isMostConclusive = $isMostConclusive;
    }
    
    public function getIsSignificant()
    {
        return $this->isSignificant;
    }
    
    public function setIsSignificant($isSignificant)
    {
        $this->isSignificant = $isSignificant;
    }
    
    public function getSignificance()
    {
        return $this->significance;
    }
    
    public function setSignificance($significance)
    {
        $this->significance = $significance;
    }
    
    public function getValue()
    {
        return $this->value;
    }
    
    public function setValue($value)
    {
        $this->value = $value;
    }
    
    public function getVisitorsRemaining()
    {
        return $this->visitorsRemaining;
    }
    
    public function setVisitorsRemaining($visitorsRemaining)
    {
        $this->visitorsRemaining = $visitorsRemaining;
    }
}








