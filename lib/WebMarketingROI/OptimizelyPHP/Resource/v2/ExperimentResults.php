<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 12 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;
use WebMarketingROI\OptimizelyPHP\Resource\v2\ExperimentMetricResults;
use WebMarketingROI\OptimizelyPHP\Resource\v2\ExperimentVariationReach;

/**
 * Optimizely experiment results.
 */
class ExperimentResults
{
    /**
     * The significance level at which you would like to declare winning and 
     * losing variations. A lower number minimizes the time needed to declare 
     * a winning or losing variation, but increases the risk that your results 
     * aren't true winners and losers.
     * @var number
     */
    private $confidenceThreshold;
    
    /**
     * The latest time to count events in results
     * @var string
     */
    private $endTime;
    
    /**
     * The unique identifier for the Experiment.
     * @var type 
     */
    private $experimentId;
    
    /**
     * The breakdown of experiment results by metric
     * @var array[ExperimentMetricResult]
     */
    private $metrics;
    
    /**
     * The total number of users exposed to a different experience
     * @var ExperimentVariationReach
     */
    private $reach;
    
    /**
     * The earliest time to count events in results
     * @var string 
     */
    private $startTime;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'confidence_threshold': $this->setConfidenceThreshold($value); break;
                case 'end_time': $this->setEndTime($value); break;
                case 'experiment_id': $this->setExperimentId($value); break;
                case 'metrics': {
                    $metrics = array();
                    foreach ($value as $metricInfo) {
                        $metrics[] = new ExperimentMetricResults($metricInfo);                        
                    }
                    $this->setMetrics($metrics); 
                    break;
                }
                case 'reach': $this->setReach(new ExperimentVariationReach($value)); break;
                case 'start_time': $this->setStartTime($value); break;
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
            'confidence_threshold' => $this->getConfidenceThreshold(),
            'end_time' => $this->getEndTime(),
            'experiment_id' => $this->getExperimentId(),
            'metrics' => array(),
            'reach' => $this->getReach()?$this->getReach()->toArray():null,
            'start_time' => $this->getStartTime()
        );
        
        foreach ($this->getMetrics() as $metric) {
            $options['metrics'][] = $metric->toArray();
        }
        
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
    }
    
    public function getConfidenceThreshold()
    {
        return $this->confidenceThreshold;
    }
    
    public function setConfidenceThreshold($confidenceThreshold)
    {
        $this->confidenceThreshold = $confidenceThreshold;
    }
    
    public function getEndTime()
    {
        return $this->endTime;
    }
    
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }
    
    public function getExperimentId()
    {
        return $this->experimentId;
    }
    
    public function setExperimentId($experimentId)
    {
        $this->experimentId = $experimentId;
    }
    
    public function getMetrics()
    {
        return $this->metrics;
    }
    
    public function setMetrics($metrics)
    {
        $this->metrics = $metrics;
    }
    
    public function getReach()
    {
        return $this->reach;
    }
    
    public function setReach($reach)
    {
        $this->reach = $reach;
    }
    
    public function getStartTime()
    {
        return $this->startTime;
    }
    
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }
}










