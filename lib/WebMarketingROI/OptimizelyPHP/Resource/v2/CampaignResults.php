<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 12 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;
use WebMarketingROI\OptimizelyPHP\Resource\v2\CampaignMetricResults;

/**
 * Optimizely campaign results.
 */
class CampaignResults
{
    /**
     * The unique identifier for the Campaign
     * @var integer
     */
    private $campaignId;
    
    /**
     * The significance level at which you would like to declare winning and 
     * losing variations. A lower number minimizes the time needed to declare a 
     * winning or losing variation, but increases the risk that your results 
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
     * The breakdown of campaign results by metric.
     * @var array[CampaignMetricResults]
     */
    private $metrics;
    
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
                case 'campaign_id': $this->setCampaignId($value); break;
                case 'confidence_threshold': $this->setConfidenceThreshold($value); break;
                case 'end_time': $this->setEndTime($value); break;
                case 'metrics': {
                    $metrics = array();
                    foreach ($value as $metricInfo) {
                        $metrics[] = new CampaignMetricResults($metricInfo);
                    }
                    $this->setMetrics($metrics); 
                    break;
                }
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
            'campaign_id' => $this->getCampaignId(),
            'confidence_threshold' => $this->getConfidenceThreshold(),
            'end_time' => $this->getEndTime(),
            'metrics' => array(),
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
    
    public function getCampaignId()
    {
        return $this->campaignId;
    }
    
    public function setCampaignId($campaignId)
    {
        $this->campaignId = $campaignId;
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
    
    public function getMetrics()
    {
        return $this->metrics;
    }
    
    public function setMetrics($metrics)
    {
        $this->metrics = $metrics;
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




