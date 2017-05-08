<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 05 May 2017
 * @copyright (c) 2017, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;

/**
 * Optimizely attribute.
 */
class Attribute
{
    /**
     * Unique string identifier for this Attribute within the project
     * @var string
     */
    private $key;
    
    /**
     * The ID of the project the Attribute belongs to
     * @var integer
     */
    private $projectId;
    
    /**
     * Whether or not the Attribute has been archived
     * @var boolean
     */
    private $archived;
    
    /**
     * A short description of the Attribute
     * @var string
     */
    private $description;
    
    /**
     * The name of the Attribute
     * @var string
     */
    private $name;
    
    /**
     * Whether this Attribute is a custom dimension or custom attribute. If this 
     * is a custom dimension, it belongs to an Optimizely Classic experiment and 
     * is read-only.
     * Can be custom_attribute or custom_dimension
     */
    private $conditionType;
    
    /**
     * The unique identifier for the Attribute
     * @var integer
     */
    private $id;
    
    /**
     * The last time the Attribute was modified
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
                case 'key': $this->setKey($value); break;
                case 'project_id': $this->setProjectId($value); break;
                case 'archived': $this->setArchived($value); break;
                case 'description': $this->setDescription($value); break;
                case 'name': $this->setName($value); break;
                case 'condition_type': $this->setConditionType($value); break;
                case 'id': $this->setId($value); break;
                case 'last_modified': $this->setLastModified($value); break;
                default:
                    throw new Exception('Unknown option found in the Attribute entity: ' . $name);
            }
        }
    }
    
    /**
     * Returns this object as array.
     */
    public function toArray()
    {
        $options = array(            
            'key' => $this->getKey(),
            'project_id' => $this->getProjectId(),
            'archived' => $this->getArchived(),
            'description' => $this->getDescription(),
            'name' => $this->getName(),
            'condition_type' => $this->getConditionType(),
            'id' => $this->getId(),
            'last_modified' => $this->getLastModified(),
        );
        
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
    }
    
    public function getKey()
    {
        return $this->key;
    }
    
    public function setKey($key)
    {
        $this->key = $key;
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
    
    public function getConditionType()
    {
        return $this->conditionType;
    }
    
    public function setConditionType($conditionType)
    {
        $this->conditionType = $conditionType;
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










