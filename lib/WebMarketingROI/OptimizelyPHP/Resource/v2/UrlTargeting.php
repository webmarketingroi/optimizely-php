<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 05 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;

/**
 * An Optimizely experiment.
 */
class UrlTargeting
{
    /**
     * Conditions to activate the experiment; our knowledge base article on 
     * Activation Types is the best guide for how to set up this data.
     * @var type 
     */
    private $conditions;
    
    /**
     * URL to load in the editor for this page
     * @var type 
     */
    private $editUrl;
    
    /**
     * Stringified Javascript function that determines when the Page is activated. 
     * Only required when activation_type is 'polling' or 'callback'.
     * @var type 
     */
    private $activationCode;
    
    /**
     * How this page is activated. See the full documentation on the Page object.
     * @var type 
     */
    private $activationType;
    
    /**
     * Unique string identifier for this Page within the Project
     * @var type 
     */
    private $key;
    
    /**
     * The unique identifier of the Page that represents the experiment or campaign's URL Targeting.
     * @var type 
     */
    private $pageId;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {
                case 'conditions': $this->setConditions($value); break;
                case 'edit_url': $this->setEditUrl($value); break;
                case 'activation_code': $this->setActivationCode($value); break;
                case 'activation_type': $this->setActivationType($value); break;
                case 'key': $this->setKey($value); break;
                case 'page_id': $this->setPageId($value); break;
                
                default:
                    throw new Exception('Unknown option found in the UrlTargeting entity: ' . $name);
            }
        }
    }
    
    /**
     * Returns this object as array.
     */
    public function toArray()
    {
        $options = array(
            'conditions' => $this->getConditions(),
            'edit_url' => $this->getEditUrl(),
            'activation_code' => $this->getActivationCode(),
            'activation_type' => $this->getActivationType(),
            'key' => $this->getKey(),
            'page_id' => $this->getPageId(),
        );
                
        return $cleanedOptions;
    }
    
    public function getConditions()
    {
        return $this->conditions;
    }
    
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;
    }
    
    public function getEditUrl()
    {
        return $this->editUrl;
    }
    
    public function setEditUrl($editUrl)
    {
        $this->editUrl = $editUrl;
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
    
    public function getKey()
    {
        return $this->key;
    }
    
    public function setKey($key)
    {
        $this->key = $key;
    }
    
    public function getPageId()
    {
        return $this->pageId;
    }
    
    public function setPageId($pageId)
    {
        $this->pageId = $pageId;
    }
}

