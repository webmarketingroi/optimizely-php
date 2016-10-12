<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 12 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

/**
 * Optimizely experiment variation reach.
 */
class ExperimentVariationReach
{
    /**
     * Baseline count
     * @var integer
     */
    private $baselineCount;
    
    /**
     * Baseline reach
     * @var number
     */
    private $baselineReach;
    
    /**
     * Total number of visitors exposed to the experiment
     * @var integer 
     */
    private $totalCount;
    
    /**
     * Treatment count
     * @var number
     */
    private $treatmentCount;
    
    /**
     * Treatment reach
     * @var number
     */
    private $treatmentReach;
    
    /**
     * A map of reach for each Variation keyed by Variation ID
     * @var array[VariationREach]
     */
    private $variations;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'baseline_count': $this->setBaselineCount($value); break;
                case 'baseline_reach': $this->setBaselineReach($value); break;
                case 'total_count': $this->setTotalCount($value); break;
                case 'treatment_count': $this->setTreatmentCount($value); break;
                case 'treatment_reach': $this->setTreatmentReach($value); break;
                case 'variations': $this->setVariations($value); break;                
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
            'baseline_count' => $this->getBaselineCount(),
            'baseline_reach' => $this->getBaselineReach(),
            'total_count' => $this->getTotalCount(),
            'treatment_count' => $this->getTreatmentCount(),
            'treatment_reach' => $this->getTreatmentReach(),
            'variations' => $this->getVariations(),            
        );
    }
    
    public function getBaselineCount()
    {
        return $this->baselineCount;
    }
    
    public function setBaselineCount($baselineCount)
    {
        $this->baselineCount = $baselineCount;
    }
    
    public function getBaselineReach()
    {
        return $this->baselineReach;
    }
    
    public function setBaselineReach($baselineReach)
    {
        $this->baselineReach = $baselineReach;
    }
    
    public function getTotalCount()
    {
        return $this->totalCount;
    }
    
    public function setTotalCount($totalCount)
    {
        $this->totalCount = $totalCount;
    }
    
    public function getTreatmentCount()
    {
        return $this->treatmentCount;
    }
    
    public function setTreatmentCount($treatmentCount)
    {
        $this->treatmentCount = $treatmentCount;
    }
    
    public function getTreatmentReach()
    {
        return $this->treatmentReach;
    }
    
    public function setTreatmentReach($treatmentReach)
    {
        $this->treatmentReach;
    }
    
    public function getVariations()
    {
        return $this->variations;
    }
    
    public function setVariations($variations)
    {
        $this->variations = $variations;
    }
}











