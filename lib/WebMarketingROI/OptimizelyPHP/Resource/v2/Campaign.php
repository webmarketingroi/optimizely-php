<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 06 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

/**
 * An Optimizely campaign.
 */
class Campaign
{
    /**
     * The Project ID the Campaign is in
     * @var integer
     */
    private $projectId;
    
    /**
     * A list of changes to apply to the Campaign
     * @var array 
     */
    private $changes;
    
    /**
     * The time the Experiment was initially created
     * @var string
     */
    private $created;
    
    /**
     * The first time the Experiment was activated
     * @var string
     */
    private $earliest;
    
    /**
     * An ordered list of Experiment IDs used by the Campaign
     * @var array
     */
    private $experimentIds;
    
    /**
     * Percentage expressed as a number from 0-10000 to holdback from being 
     * included in the experiment.
     * @var integer
     */
    private $holdback;
    
    /**
     * The last time the Experiment was modified
     * @var string
     */
    private $lastModified;
    
    /**
     * The last time the Experiment was activated (not present if it is still activated)
     * @var string 
     */
    private $latest;
    
    /**
     * An ordered list of Metrics to track for the Campaign
     * @var array
     */
    private $metrics;
    
    /**
     * The name of the Campaign
     * @var string
     */
    private $name;
    
    /**
     * A list of Page IDs used in the Campaign.
     * @var array
     */
    private $pageIds;
    
    /**
     * Current state of the Campaign. Can be 'active', 'paused' or 'archived'
     * @var string
     */
    private $status;
    
    /**
     * The type of the Campaign. Can be a/b or personalization.
     * @var string
     */
    private $type;
    
    /**
     * The unique identifier for the Campaign
     * @var integer
     */
    private $id;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'project_id': $this->setProjectId($value); break;
                case 'changes': $this->setChanges($value); break;
                case 'created': $this->setCreated($value); break;
                case 'earliest': $this->setEarliest($value); break;
                case 'experiment_ids': $this->setExperimentIds($value); break;
                case 'holdback': $this->setHoldback($value); break;
                case 'last_modified': $this->setLastModified($value); break;
                case 'latest': $this->setLatest($value); break;
                case 'metrics': $this->setMetrics($value); break;
                case 'name': $this->setName($value); break;
                case 'page_ids': $this->setPageIds($value); break;
                case 'status': $this->setStatus($value); break;
                case 'type': $this->setType($value); break;
                case 'id': $this->setId($value); break;
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
            'changes' => $this->changes,
            'created' => $this->created,
            'earliest' => $this->earliest,
            'experiment_ids' => $this->experimentIds,
            'holdback' => $this->holdback,
            'last_modified' => $this->lastModified,
            'latest' => $this->latest,
            'metrics' => $this->metrics,
            'name' => $this->name,
            'page_ids' => $this->pageIds,
            'status' => $this->status,
            'type' => $this->type,
            'id' => $this->id
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
    
    public function getEarliest()
    {
        return $this->earliest;
    }
    
    public function setEarliest($earliest)
    {
        $this->earliest = $earliest;
    }
    
    public function getExperimentIds()
    {
        return $this->experimentIds;
    }
    
    public function setExperimentIds($experimentIds)
    {
        $this->experimentIds = $experimentIds;
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
    
    public function getLatest()
    {
        return $this->latest;
    }
    
    public function setLatest($latest)
    {
        $this->latest = $latest;
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
    
    public function getPageIds()
    {
        return $this->pageIds;
    }
    
    public function setPageIds($pageIds)
    {
        $this->pageIds = $pageIds;
    }
    
    public function getStatus()
    {
        return $this->status;
    }
    
    public function setStatus($status)
    {
        $this->status = $status;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
}




