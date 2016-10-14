<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 12 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Resource\v2\VariantResults;

/**
 * Optimizely campaign metric results.
 */
class CampaignMetricResults
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
     * the sum of all revenue sent from all events in the Campaign. 
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
     * A map of results for the variants affected by the campaign. Variants may 
     * represent aggregated results scoped to the campaign and/or individual 
     * experiment results scoped to just that experiment. The special variant 
     * 'baseline' represents visitors that have been held back from any change 
     * in experience across all Experiments in the Campaign. The special variant 
     * 'campaign' represents the aggregated effect of all experiments included in 
     * the Campaign.
     * @var VariantResults
     */
    private $results;
    
    /**
     * Can be 'session', 'visitor' or 'event'.
     * @var string
     */
    private $unit;
    
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
                case 'results': {
                    $results = array();
                    foreach ($value as $name=>$info) {
                        $results[$name] = new VariantResults($info);
                    }
                    $this->setResults($results); 
                    break;
                }
                case 'unit': $this->setUnit($value); break;
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
        $options = array(
            'event' => $this->getEvent(),
            'event_name' => $this->getEventName(),
            'measure' => $this->getMeasure(),
            'metric_id' => $this->getMetricId(),
            'priority' => $this->getPriority(),
            'results' => array(),
            'unit' => $this->getUnit()
        );
        
        foreach ($this->getResults() as $name=>$result) {
            $options['results'][$name] = $result->toArray();
        }
        
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
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
    
    public function getResults()
    {
        return $this->results;
    }
    
    public function setResults($results)
    {
        $this->results = $results;
    }
    
    public function getUnit()
    {
        return $this->unit;
    }
    
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }
}






