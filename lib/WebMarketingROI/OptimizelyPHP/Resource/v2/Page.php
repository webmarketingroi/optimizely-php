<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 07 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;

/**
 * An Optimizely project page.
 */
class Page
{
    /**
     * URL of the Page
     * @var string
     */
    private $editUrl;
    
    /**
     * Name of the Page
     * @var string 
     */
    private $name;
    
    /**
     * ID of the Page's project
     * @var integer 
     */
    private $projectId;
    
    /**
     * Code to determine Experiment start
     * @var string 
     */
    private $activationCode;
    
    /**
     * Page activation type. Can be immediate, manual, polling or callback
     * @var string 
     */
    private $activationType;
    
    /**
     *
     * @var string 
     */
    private $apiName;
    
    /**
     * Whether the Page has been archived
     * @var boolean 
     */
    private $archived;
    
    /**
     * The category this Page is grouped under. Can be article, cart, category, 
     * checkout, home, landing_page, pricing, product_detail, search_results or other
     * @var string
     */
    private $category;
    
    /**
     * Conditions that activate the Page
     * @var string 
     */
    private $conditions;
    
    /**
     * Unique string identifier for this page within the project.
     * @var string
     */
    private $key;
    
    /**
     * Type of Page. Can be single_url, url_set or global
     * @var string
     */
    private $pageType;
    
    /**
     * Date created
     * @var string
     */
    private $created;
    
    /**
     * The unique identifier of the Page
     * @var integer 
     */
    private $id;
    
    /**
     * Date last modified
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
                case 'edit_url': $this->setEditUrl($value); break;
                case 'name': $this->setName($value); break;    
                case 'project_id': $this->setProjectId($value); break;
                case 'activation_code': $this->setActivationCode($value); break;
                case 'activation_type': $this->setActivationType($value); break;
                case 'api_name': $this->setApiName($value); break;
                case 'archived': $this->setArchived($value); break;
                case 'category': $this->setCategory($value); break;
                case 'conditions': $this->setConditions($value); break;
                case 'key': $this->setKey($value); break;
                case 'page_type': $this->setPageType($value); break;                
                case 'created': $this->setCreated($value); break;
                case 'id': $this->setId($value); break;
                case 'last_modified': $this->setLastModified($value); break;
                default:
                    throw new Exception('Unknown option found in the Page entity: ' . $name);
            }
        }
    }
    
    /**
     * Returns this object as array.
     */
    public function toArray()
    {
        $options = array(
            'edit_url' => $this->getEditUrl(),
            'name' => $this->getName(),
            'project_id' => $this->getProjectId(),
            'activation_code' => $this->getActivationCode(),
            'activation_type' => $this->getActivationType(),
            'api_name' => $this->getApiName(),
            'archived' => $this->getArchived(),
            'category' => $this->getCategory(),
            'conditions' => $this->getConditions(),
            'key' => $this->getKey(),
            'page_type' => $this->getPageType(),            
            'created' => $this->getCreated(),
            'id' => $this->getId(),
            'last_modified' => $this->getLastModified()
        );
        
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
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
    
    public function getKey()
    {
        return $this->key;
    }
    
    public function setKey($key)
    {
        $this->key = $key;
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








