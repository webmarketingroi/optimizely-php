<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 12 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Change;

/**
 * Optimizely action.
 */
class Action
{
    /**
     * The list of changes to apply to the Page
     * @var array[Change] 
     */
    private $changes;
    
    /**
     * The Page ID to apply changes to
     * @var integer 
     */
    private $pageId;
    
    /**
     * The share link for the provided Variation and Page combination
     * @var string 
     */
    private $shareLink;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'changes': {
                    $changes = array();
                    foreach ($value as $changeInfo) {
                        $changes[] = new Change($changeInfo);
                    }
                    $this->setChanges($changes); break;
                }
                case 'page_id': $this->setPageId($value); break;
                case 'share_link': $this->setShareLink($value); break;
                default:
                    throw new Exception('Unknown option found in the Action entity: ' . $name);
            }
        }
    }
    
    /**
     * Returns this object as array.
     */
    public function toArray()
    {
        $options = array(
            'changes' => array(),
            'page_id' => $this->getPageId(),   
            'share_link' => $this->getShareLink(),
        );
        
        foreach ($this->getChanges() as $change) {
            $options['changes'][] = $change->toArray();
        }
        
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
    }
    
    public function getChanges()
    {
        return $this->changes;
    }
    
    public function setChanges($changes)
    {
        $this->changes = $changes;
    }
    
    public function getPageId()
    {
        return $this->pageId;
    }
    
    public function setPageId($pageId)
    {
        $this->pageId = $pageId;
    }
    
    public function getShareLink()
    {
        return $this->shareLink;
    }
    
    public function setShareLink($shareLink)
    {
        $this->shareLink = $shareLink;
    }
}










