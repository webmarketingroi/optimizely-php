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
    /**
     * The project the Experiment is in
     * @var integer
     */
    private $projectId;
    
    /**
     * List of IDs of all audiences the Experiment is targeted at
     * @var array[integer] 
     */
    private $audienceIds;
    
    /**
     * The ID for the Campaign that the Experiment is in
     * @var integer 
     */
    private $campaignId;
    
    /**
     * Experiment-level changes that will run before all Variations. Typically 
     * this is custom CSS or custom JavaScript.
     * @var array[Change] 
     */
    private $changes;
    
    /**
     * The time the experiment was initially created
     * @var string 
     */
    private $created;
    
    /**
     * The description or hypothesis for an Experiment
     * @var string 
     */
    private $description;
    
    /**
     * Percentage expressed as a number from 0-10000 to hold back from being 
     * included in the experiment
     * @var integer 
     */
    private $holdback;
    
    /**
     * The last time the experiment was modified
     * @var string 
     */
    private $lastModified;
    
    /**
     * An ordered list of metrics to track for the experiment
     * @var array[Metric] 
     */
    private $metrics;
    
    /**
     * Name of the Experiment
     * @var string 
     */
    private $name;
    
    /**
     * The last time the experiment was modified
     * @var Schedule 
     */
    private $schedule;
    
    /**
     * Current state of the experiment. Can be 'active', 'paused' or 'archived'.
     * @var string 
     */
    private $status;
    
    /**
     * A list of Variations that each define an experience to show in the context 
     * of the Experiment for the purpose of comparison against each other
     * @var array[Variation]
     */
    private $variations = array();
    
    /**
     * The unique identifier for the Experiment
     * @var integer 
     */
    private $id;
    
    /**
     * Whether or not the Experiment is a classic Experiment
     * @var boolean
     */
    private $isClassic;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {
                case 'project_id': $this->setProjectId($value); break;
                case 'audience_ids': $this->setAudienceIds($value); break;
                case 'campaign_id': $this->setCampaignId($value); break;
                case 'changes': $this->setChanges($value); break;
                case 'created': $this->setCreated($value); break;    
                case 'description': $this->setDescription($value); break;    
                case 'holdback': $this->setHoldback($value); break;    
                case 'last_modified': $this->setLastModified($value); break;    
                case 'metrics': $this->setMetrics($value); break;    
                case 'name': $this->setName($value); break;    
                case 'schedule': $this->setSchedule($value); break;    
                case 'status': $this->setStatus($value); break;
                case 'variations': $this->setVariations($value); break;
                case 'id': $this->setId($value); break;
                case 'is_classic': $this->setIsClassic($value); break;                
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
            'project_id' => $this->projectId,
            'audience_ids' => $this->audicenceIds,
            'campaign_id' => $this->campaignId,
            'changes' => $this->changes,
            'created' => $this->created,
            'description' => $this->description,
            'holdback' => $this->holdback,
            'last_modified' => $this->lastModified,
            'metrics' => $this->metrics,
            'name' => $this->name,
            'schedule' => $this->schedule,
            'status' => $this->status,
            'variations' => $this->variations,
            'id' => $this->id,
            'is_classic' => $this->isClassic,
        );
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
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getIsClassic()
    {
        return $this->isClassic;
    }
    
    public function setIsClassic($isClassic)
    {
        $this->isClassic = $isClassic;
    }
}

