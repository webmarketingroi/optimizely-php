<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 12 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;
use WebMarketingROI\OptimizelyPHP\Resource\v2\VariantResults;

/**
 * Optimizely experiment metric results.
 */
class ExperimentMetricResults
{
    /**
     * The aggregation function for the numerator of the metric. 'unique' measures 
     * the number of unique visitors/sessions that include the specified Event. 
     * 'count' measures the total number of occurrences of Event for the scope 
     * (visitor/session). 'sum' is the sum of the 'field' value. 'exit' measures 
     * the ratio of sessions with last activation occurring on the target page to 
     * the sessions that activated the target page at least once during the session. 
     * 'bounce' measures the ratio of sessions that with first and last activation 
     * occurring on the target page to the sessions with first activation on the 
     * target page. For both 'exit' and 'bounce', the eventId must be the ID of a Page.
     * 
     * @var string 
     */
    private $aggregator;
    
    /**
     * 
     * @var string
     */
    private $eventId;
    
    /**
     *
     * @var string
     */
    private $eventName;
    
    /**
     *
     * @var type 
     */
    private $field;
    
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
     * 
     * @var string 
     */
    private $name;
    
    /**
     * A map of results for each variation in the Experiment keyed by variation ID. 
     * For Personalization Campaigns, the special variant 'baseline' represents 
     * visitors that have been held back from any change in experience for the Experiment
     * 
     * @var object[VariantResults]
     */
    private $results;
    
    /**
     *
     * @var string 
     */
    private $scope;
    
    /**
     *
     * @var type 
     */
    private $winningDirection;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'aggregator': $this->setAggregator($value); break;
                case 'event_id': $this->setEventId($value); break;
                case 'event_name': $this->setEventName($value); break;
                case 'field': $this->setField($value); break;
                case 'measure': $this->setMeasure($value); break;
                case 'metric_id': $this->setMetricId($value); break;
                case 'priority': $this->setPriority($value); break;
                case 'unit': $this->setUnit($value); break;
                case 'results': {
                    $results = [];
                    foreach ($value as $result) {
                        $results[] = new VariantResults($result);
                    }
                    $this->setResults($results); break;
                }
                case 'name': $this->setName($value); break;
                case 'scope': $this->setScope($value); break;
                case 'winning_direction': $this->setWinningDirection($value); break;
                default:
                    throw new Exception('Unknown option found in the ExperimentMetricResults entity: ' . $name);
            }
        }
    }
    
    /**
     * Returns this object as array.
     */
    public function toArray()
    {
        return array(
            'aggregator' => $this->getAggregator(),
            'event_id' => $this->getEventId(),
            'event_name' => $this->getEventName(),
            'field' => $this->getField(),
            'measure' => $this->getMeasure(),
            'metric_id' => $this->getMetricId(),
            'priority' => $this->getPriority(),
            'unit' => $this->getUnit(),
            'results' => $this->getResults()->toArray(),
            'name' => $this->getName(),
            'scope' => $this->getScope(),
            'winning_direction' => $this->getWinningDirection(),
        );
    }
    
    public function getAggregator()
    {
        return $this->aggregator;
    }
    
    public function setAggregator($aggregator)
    {
        $this->aggregator = $aggregator;
    }
    
    public function getEventId()
    {
        return $this->eventId;
    }
    
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;
    }
    
    public function getEventName()
    {
        return $this->eventName;
    }
    
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;
    }
    
    public function getField()
    {
        return $this->field;
    }
    
    public function setField($field)
    {
        $this->field = $field;
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
    
    public function getResults()
    {
        return $this->results;
    }
    
    public function setResults($results)
    {
        $this->results = $results;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getScope()
    {
        return $this->scope;
    }
    
    public function setScope($scope)
    {
        $this->scope = $scope;
    }
    
    public function getWinningDirection()
    {
        return $this->winningDirection;
    }
    
    public function setWinningDirection($winningDirection)
    {
        $this->winningDirection = $winningDirection;
    }
}










