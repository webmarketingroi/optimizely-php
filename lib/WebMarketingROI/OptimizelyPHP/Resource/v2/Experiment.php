<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 05 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

/**
 * An Optimizely experiment.
 */
class Experiment
{
    private $projectId;
    
    private $audienceIds;
    
    private $campaignId;
    
    private $changes;
    
    private $created;
    
    private $description;
    
    private $holdback;
    
    private $lastModified;
    
    private $metrics;
    
    private $name;
    
    private $schedule;
    
    private $status;
    
    private $variations = array();
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {
                case 'project_id': $this->setProjectId($value); break;
                case 'name': $this->setName($value); break;
                case 'created': $this->setCreated($value); break;
                default:
                    throw new \Exception('Unknown option: ' . $name);
            }
        }
    }
    
    public function getProjectId()
    {
        return $this->projectId;
    }
    
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
    }
    
    public function getAudienceIds()
    {
        return $this->audienceIds;
    }
    
    public function setAudienceIds($audienceIds)
    {
        $this->audienceIds = $audienceIds;
    }
    
    public function getCampaignId()
    {
        return $this->campaignId;
    }
    
    public function setCampaignId($campaignId)
    {
        $this->campaignId = $campaignId;
    }
    
    public function getChanges()
    {
        return $this->changes;
    }
    
    public function setChanges($changes)
    {
        $this->changes = $changes;
    }
    
    public function getCreated()
    {
        return $this->created;
    }
    
    public function setCreated($created)
    {
        $this->created = $created;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    public function getHoldback()
    {
        return $this->holdback;
    }
    
    public function setHoldback($holdback)
    {
        $this->holdback = $holdback;
    }
    
    public function getLastModified()
    {
        return $this->lastModified;
    }
    
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;
    }
    
    public function getMetrics()
    {
        return $this->metrics;
    }
    
    public function setMetrics($metrics)
    {
        $this->metrics = $metrics;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getSchedule()
    {
        return $this->schedule;
    }
    
    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
    }
    
    public function getStatus()
    {
        return $this->status;
    }
    
    public function setStatus($status)
    {
        $this->status = $status;
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

