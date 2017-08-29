<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 05 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Schedule;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Variation;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Change;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Metric;

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
     * Unique string identifier for this experiment within the project.
     * @var string
     */
    private $key;
    
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
     * Indicates whether this is a standalone a/b experiment or an experience within a personalization campaign
     * Can be a/b or personalization
     * @var string
     */
    private $type;
    
    /**
     * The audiences that should see this experiment. If the field is null or 
     * omitted, the experiment will target everyone. Multiple audiences can be 
     * combined with "and" or "or" using the same structure as audience conditions
     * @var string 
     */
    private $audienceConditions;
    
    /**
     * Traffic allocation policy across variations in this experiment
     * @var string 
     */
    private $allocationPolicy;
    
    /**
     * The first time the Experiment was activated
     * @var type 
     */
    private $earliest;
    
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
                case 'changes': {
                    $changes = array();
                    foreach ($value as $changeInfo) {
                        $changes[] = new Change($changeInfo);
                    }
                    $this->setChanges($changes); 
                    break;
                }
                case 'created': $this->setCreated($value); break;    
                case 'description': $this->setDescription($value); break;    
                case 'holdback': $this->setHoldback($value); break;    
                case 'key': $this->setKey($value); break;    
                case 'last_modified': $this->setLastModified($value); break;    
                case 'metrics': {
                    $metrics = array();
                    foreach ($value as $metricInfo) {
                        $metrics[] = new Metric($metricInfo);
                    }
                    $this->setMetrics($metrics); 
                    break;    
                }
                case 'name': $this->setName($value); break;    
                case 'schedule': $this->setSchedule(new Schedule($value)); break;    
                case 'status': $this->setStatus($value); break;
                case 'variations': {
                    $variations = array();
                    foreach ($value as $variationInfo) {
                        $variations[] = new Variation($variationInfo);
                    }
                    $this->setVariations($variations); 
                    break;
                }
                case 'id': $this->setId($value); break;
                case 'is_classic': $this->setIsClassic($value); break;                
                case 'type': $this->setType($value); break;
                case 'audience_conditions': $this->setAudienceConditions($value); break;
                case 'allocation_policy': $this->setAllocationPolicy($value); break;
                case 'earliest': $this->setEarliest($value); break;
                default:
                    throw new Exception('Unknown option found in the Experiment entity: ' . $name);
            }
        }
    }
    
    /**
     * Returns this object as array.
     */
    public function toArray()
    {
        $options = array(
            'project_id' => $this->getProjectId(),
            'audience_ids' => $this->getAudienceIds(),
            'campaign_id' => $this->getCampaignId(),
            'created' => $this->getCreated(),
            'description' => $this->getDescription(),
            'holdback' => $this->getHoldback(),
            'key' => $this->getKey(),
            'last_modified' => $this->getLastModified(),
            'name' => $this->getName(),
            'schedule' => $this->getSchedule()?$this->getSchedule()->toArray():null,
            'status' => $this->getStatus(),            
            'id' => $this->getId(),
            'is_classic' => $this->getIsClassic(),
            'type' => $this->getType(),
            'audience_conditions' => $this->getAudienceConditions(),  
            'allocation_policy' => $this->getAllocationPolicy(),
            'earliest' => $this->getEarliest(),
        );
        
        if ($this->getChanges()) {
            
            $options['changes'] = array();
            
            foreach ($this->getChanges() as $change) {
                $options['changes'][] = $change->toArray();
            }
        }
        
        if ($this->getMetrics()) {
            
            $options['metrics'] = array();
            
            foreach ($this->getMetrics() as $metric) {
                $options['metrics'][] = $metric->toArray();
            }
        }
        
        if ($this->getVariations()) {
            
            $options['variations'] = array();
            
            foreach ($this->getVariations() as $variation) {
                $options['variations'][] = $variation->toArray();
            }
        }
        
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
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
    
    public function getKey()
    {
        return $this->key;
    }
    
    public function setKey($key)
    {
        $this->key = $key;
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
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
    }
    
    public function getAudienceConditions()
    {
        return $this->audienceConditions;
    }
    
    public function setAudienceConditions($audienceConditions)
    {
        $this->audienceConditions = $audienceConditions;
    }
    
    public function getConfig()
    {
        return $this->config;
    }
    
    public function setConfig($config)
    {
        $this->config = $config;
    }
    
    public function getAllocationPolicy()
    {
        return $this->allocationPolicy;
    }
    
    public function setAllocationPolicy($allocationPolicy)
    {
        $this->allocationPolicy = $allocationPolicy;
    }
    
    public function getEarliest()
    {
        return $this->earliest;
    }
    
    public function setEarliest($earliest)
    {
        $this->earliest = $earliest;
    }
}

