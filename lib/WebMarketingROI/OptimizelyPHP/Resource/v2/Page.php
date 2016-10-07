<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 07 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

/**
 * An Optimizely project page.
 */
class Page
{
    private $editUrl;
    
    private $name;
    
    private $projectId;
    
    private $activationCode;
    
    private $activationType;
    
    private $apiName;
    
    private $archived;
    
    private $category;
    
    private $conditions;
    
    private $pageType;
    
    private $created;
    
    private $id;
    
    private $lastModified;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'edit_url': $this->setEditUrl($value); break;
                case 'name': $this->setName($value); break;    
                case 'project_id': $this->setProjectId($value); break;
                case 'activation_code': $this->setActivationCode($value); break;
                case 'activation_type': $this->setActivationType($value); break;
                case 'api_name': $this->setApiName($value); break;
                case 'archived': $this->setArchived($value); break;
                case 'category': $this->setCategory($value); break;
                case 'conditions': $this->setConditions($value); break;
                case 'page_type': $this->setPageType($value); break;                
                case 'created': $this->setCreated($value); break;
                case 'id': $this->setId($value); break;
                case 'last_modified': $this->setLastModified($value); break;
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
            'edit_url' => $this->editUrl,
            'name' => $this->name,
            'project_id' => $this->projectId,
            'activation_code' => $this->activationCode,
            'activation_type' => $this->activationType,
            'api_name' => $this->apiName,
            'archived' => $this->archived,
            'category' => $this->category,
            'conditions' => $this->conditions,
            'page_type' => $this->page_type,            
            'created' => $this->created,
            'id' => $this->id,
            'last_modified' => $this->lastModified
        );
    }
    
    public function getEditUrl()
    {
        return $this->editUrl;
    }
    
    public function setEditUrl($editUrl)
    {
        $this->editUrl = $editUrl;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getProjectId()
    {
        return $this->projectId;
    }
    
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
    }
    
    public function getActivationCode()
    {
        return $this->activationCode;
    }
    
    public function setActivationCode($activationCode)
    {
        $this->activationCode = $activationCode;
    }
    
    public function getActivationType()
    {
        return $this->activationType;
    }
    
    public function setActivationType($activationType)
    {
        $this->activationType = $activationType;
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
    
    public function getConditions()
    {
        return $this->conditions;
    }
    
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;
    }
    
    public function getPageType()
    {
        return $this->pageType;
    }
    
    public function setPageType($pageType)
    {
        $this->pageType = $pageType;
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








