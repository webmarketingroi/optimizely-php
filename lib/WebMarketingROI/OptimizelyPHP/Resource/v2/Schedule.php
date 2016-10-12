<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 12 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

/**
 * Optimizely schedule.
 */
class Schedule
{
    /**
     * The start time for the Experiment
     * @var string 
     */
    private $startTime;
    
    /**
     * The stop time for the Experiment
     * @var string 
     */
    private $stopTime;
    
    /**
     * The time zone to use for Experiment start/stop times
     * @var string 
     */
    private $timezone;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'start_time': $this->setStatTime($value); break;
                case 'stop_time': $this->setStopTime($value); break;
                case 'time_zone': $this->setTimezone($value); break;
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
            'start_time' => $this->startTime,
            'stop_time' => $this->stopTime,
            'time_zone' => $this->timezone,            
        );
    }
    
    public function getStartTime()
    {
        return $this->startTime;
    }
    
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }
    
    public function getStopTime()
    {
        return $this->stopTime;
    }
    
    public function setStopTime($stopTime)
    {
        $this->stopTime = $stopTime;
    }
    
    public function getTimezone()
    {
        return $this->timezone;
    }
    
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }
}







