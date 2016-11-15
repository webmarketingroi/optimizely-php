<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 07 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;

/**
 * An Optimizely audience.
 */
class Audience
{
    /**
     * The project the Audience was created in
     * @var integer 
     */
    private $projectId;
    
    /**
     * Whether the Audience has been archived
     * @var boolean 
     */
    private $archived;
    
    /**
     * A string defining the targeting rules for an audience.
     * @var string 
     */
    private $conditions;
    
    /**
     * A short description of the Audience
     * @var string 
     */
    private $description;
    
    /**
     * The name of the Audience
     * @var string 
     */
    private $name;
    
    /**
     * True if the audiences is available for segmentation on the results page (Platinum only).
     * @var boolean 
     */
    private $segmentation;
    
    /**
     * The time the Audience was initially created
     * @var string 
     */
    private $created;
    
    /**
     * The unique identifier for the Audience.
     * @var integer 
     */
    private $id;
    
    /**
     * The last time the Audience was modified
     * @var string 
     */
    private $lastModified;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'project_id': $this->setProjectId($value); break;
                case 'archived': $this->setArchived($value); break;
                case 'conditions': $this->setConditions($value); break;
                case 'description': $this->setDescription($value); break;
                case 'name': $this->setName($value); break;
                case 'segmentation': $this->setSegmentation($value); break;
                case 'created': $this->setCreated($value); break;
                case 'id': $this->setId($value); break;
                case 'last_modified': $this->setLastModified($value); break;
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
            'project_id' => $this->projectId,
            'archived' => $this->archived,
            'conditions' => $this->conditions,
            'description' => $this->description,
            'name' => $this->name,
            'segmentation' => $this->segmentation,
            'created' => $this->created,
            'id' => $this->id,
            'last_modified' => $this->lastModified
        );
        
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
    
    public function getArchived()
    {
        return $this->archived;
    }
    
    public function setArchived($archived)
    {
        $this->archived = $archived;
    }
    
    public function getConditions()
    {
        return $this->conditions;
    }
    
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
    }
        
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
        
    public function getSegmentation()
    {
        return $this->segmentation;
    }
    
    public function setSegmentation($segmentation)
    {
        $this->segmentation = $segmentation;
    }
    
    public function getCreated()
    {
        return $this->created;
    }
    
    public function setCreated($created)
    {
        $this->created = $created;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getLastModified()
    {
        return $this->lastModified;
    }
    
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;
    }
}






