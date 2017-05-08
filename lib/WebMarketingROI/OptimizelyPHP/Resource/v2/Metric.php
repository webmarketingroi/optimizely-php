<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 10 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;

/**
 * An Optimizely campaign metric.
 */
class Metric
{
    /**
     * The ID for the Event to select data from. Omitted for global metrics that 
     * are not relative to a specific Event, i.e. "overall revenue"
     * @var integer 
     */
    private $eventId;
    
    /**
     * The aggregation function for the numerator of the metric. 'unique' measures 
     * the number of unique visitors/sessions that include the specified Event. 'count' measures the total number of occurrences of Event for the scope (visitor/session). 'sum' is the sum of the 'field' value
     * Can be unique, count or sum
     * @var type 
     */
    private $aggregator;
    
    /**
     * The field to aggregate for the numerator of the metric. Required when 'aggregator' = 'sum', otherwise omitted
     * Can be revenue or value
     * @var string
     */
    private $field;
    
    /**
     * Specifies how Events should be grouped together. Can also be thought of 
     * as the denonimator of the metric. 'session' divides by the number of sessions. 
     * "Influenced sessions", or sessions that do not contain a decision Event but 
     * carry a decision from a previous session are not included in counts for 
     * numerator or denominator. 'visitor' divides by the number of visitors. 
     * 'event' divides by the total occurrences (impressions) of the specified Event
     * Can be session, visitor or event
     * @var string 
     */
    private $scope;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                                
                case 'event_id': $this->setEventId($value); break;
                case 'aggregator': $this->setAggregator($value); break;
                case 'field': $this->setField($value); break;
                case 'scope': $this->setScope($value); break;
                default:
                    throw new Exception('Unknown option found in the Metric entity: ' . $name);
            }
        }
    }
    
    /**
     * Returns this object as array.
     */
    public function toArray()
    {
        $options = array(
            'event_id' => $this->getEventId(),    
            'aggregator' => $this->getAggregator(),
            'field' => $this->getField(),
            'scope' => $this->getScope(),
        );
        
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
    }
    
    public function getEventId()
    {
        return $this->eventId;
    }
    
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;
    }
    
    public function getAggregator()
    {
        return $this->aggregator;
    }
    
    public function setAggregator($aggregator)
    {
        $this->aggregator = $aggregator;
    }
    
    public function getField()
    {
        return $this->field;
    }
    
    public function setField($field)
    {
        $this->field = $field;
    }
    
    public function getScope()
    {
        return $this->scope;
    }
    
    public function setScope($scope)
    {
        $this->scope = $scope;
    }
}





