<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 12 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

/**
 * Optimizely experiment metric results.
 */
class ExperimentMetricResults
{
    /**
     * 
     * @var string
     */
    private $event;
    
    /**
     *
     * @var string
     */
    private $eventName;
    
    /**
     * Conversions indicate the total number of visitors or sessions where the 
     * event happened. Impressions indicate the total number of times the event 
     * happened (possibly multiple per visitor or session). Revenue indicates 
     * the sum of all revenue sent from all events in the Experiment.
     * Can be 'conversions', 'impressions' or 'revenue'.
     * @var string
     */
    private $measure;
        
    /**
     *
     * @var string
     */
    private $metricId;
    
    /**
     *
     * @var integer
     */
    private $priority;
    
    /**
     * Can be 'session', 'visitor' or 'event'
     * @var string
     */
    private $unit;
    
    /**
     * A map of results for each Variation in the Experiment keyed by Variation ID
     * @var array[VariantResults]
     */
    private $variationResults;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'event': $this->setEvent($value); break;
                case 'event_name': $this->setEventName($value); break;
                case 'measure': $this->setMeasure($value); break;
                case 'metric_id': $this->setMetricId($value); break;
                case 'priority': $this->setPriority($value); break;
                case 'unit': $this->setUnit($value); break;
                case 'variation_results': $this->setVariationResults($value); break;
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
            'event' => $this->getEvent(),
            'event_name' => $this->getEventName(),
            'measure' => $this->getMeasure(),
            'metric_id' => $this->getMetricId(),
            'priority' => $this->getPriority(),
            'unit' => $this->getUnit(),
            'variation_results' => $this->getVariationResults(),
        );
    }
    
    public function getEvent()
    {
        return $this->event;
    }
    
    public function setEvent($event)
    {
        $this->event = $event;
    }
    
    public function getEventName()
    {
        return $this->eventName;
    }
    
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;
    }
    
    public function getMeasure()
    {
        return $this->measure;
    }
    
    public function setMeasure($measure)
    {
        $this->measure = $measure;
    }
    
    public function getMetricId()
    {
        return $this->metricId;
    }
    
    public function setMetricId($metricId)
    {
        $this->metricId = $metricId;
    }
    
    public function getPriority()
    {
        return $this->priority;
    }
    
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }
    
    public function getUnit()
    {
        return $this->unit;
    }
    
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }
    
    public function getVariationResults()
    {
        return $this->variationResults;
    }
    
    public function setVariationResults($variationResults)
    {
        $this->variationResults = $variationResults;
    }
}










