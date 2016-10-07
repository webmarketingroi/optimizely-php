<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 07 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

/**
 * An Optimizely event.
 */
class Event
{
    private $apiName;
    
    private $archived;
    
    private $category;
    
    private $created;
    
    private $description;
    
    private $eventFilter;
    
    private $eventType;
    
    private $name;
    
    private $pageId;
    
    private $projectId;
    
    private $id;
    
    private $isClassic;
    
    private $isEditable;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'apiName': $this->setApiName($value); break;
                case 'archived': $this->setArchived($value); break;
                case 'category': $this->setCategory($value); break;
                case 'created': $this->setCreated($value); break;
                case 'description': $this->setDescription($value); break;
                case 'event_filter': $this->setEventFilter($value); break;
                case 'event_type': $this->setEventType($value); break;
                case 'name': $this->setName($value); break;
                case 'page_id': $this->setPageId($value); break;
                case 'project_id': $this->setProjectId($value); break;
                case 'id': $this->setId($value); break;
                case 'is_classic': $this->setIsClassic($value); break;
                case 'is_editable': $this->setIsEditable($value); break;
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
            'api_name' => $this->apiName,
            'archived' => $this->archived,
            'category' => $this->category,
            'created' => $this->created,
            'description' => $this->description,
            'event_filter' => $this->eventFilter,
            'event_type' => $this->eventType,
            'name' => $this->name,
            'page_id' => $this->pageId,
            'project_id' => $this->projectId,
            'id' => $this->id,
            'is_classic' => $this->isClassic,
            'is_editable' => $this->isEditable
        );
    }
    
    public function getApiName()
    {
        return $this->apiName;
    }
    
    public function setApiName($apiName)
    {
        $this->apiName = $apiName;
    }
    
    public function getArchived()
    {
        return $this->archived;
    }
    
    public function setArchived($archived)
    {
        $this->archived = $archived;
    }
    
    public function getCategory()
    {
        return $this->category;
    }
    
    public function setCategory($category)
    {
        $this->category = $category;
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
        
    public function getEventFilter()
    {
        return $this->eventFilter;
    }
    
    public function setEventFilter($eventFilter)
    {
        $this->eventFilter = $eventFilter;
    }
    
    public function getEventType()
    {
        return $this->eventType;
    }
    
    public function setEventType($eventType)
    {
        $this->eventType = $eventType;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getPageId()
    {
        return $this->pageId;
    }
    
    public function setPageId($pageId)
    {
        $this->pageId = $pageId;
    }
    
    public function getProjectId()
    {
        return $this->projectId;
    }
    
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
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
    
    public function getIsEditable()
    {
        return $this->isEditable;
    }
    
    public function setIsEditable($isEditable)
    {
        $this->isEditable = $isEditable;
    }
}






