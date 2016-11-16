<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 07 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Service\v2;

use WebMarketingROI\OptimizelyPHP\Exception;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Event;
use WebMarketingROI\OptimizelyPHP\Resource\v2\ClickEvent;
use WebMarketingROI\OptimizelyPHP\Resource\v2\CustomEvent;

/**
 * Provides methods for working with Optimizely events.
 */
class Events
{
    /**
     * Optimizely API Client.
     * @var WebMarketingROI\OptimizelyPHP\OptimizelyApiClient
     */
    private $client;
    
    /**
     * Constructor.
     */
    public function __construct($client)
    {
        $this->client = $client;
    }
    
    /**
     * Get all events for a Project
     * @param integer $projectId
     * @param integer $includeClassic
     * @param integer $page
     * @param integer $perPage
     * @return Result
     * @throws Exception
     */
    public function listAll($projectId, $includeClassic, $page=1, $perPage=25)
    {
        if ($page<0) {
            throw new Exception('Invalid page number passed',
                    Exception::CODE_INVALID_ARG);
        }
        
        if ($perPage<0) {
            throw new Exception('Invalid page size passed',
                    Exception::CODE_INVALID_ARG);
        }
        
        $result = $this->client->sendApiRequest('/events', 
                array(
                    'project_id'=>$projectId,
                    'include_classic'=>$includeClassic,
                    'page'=>$page,
                    'per_page'=>$perPage
                ));
        
        $events = array();
        foreach ($result->getDecodedJsonData() as $eventInfo) {
            $event = new Event($eventInfo);
            $events[] = $event;
        }
        $result->setPayload($events);
        
        return $result;
    }
    
    /**
     * Get Event by ID
     * @param type $eventId
     * @return Result
     * @throws Exception
     */
    public function get($eventId)
    {
        if (!is_int($eventId)) {
            throw new Exception("Integer event ID expected, while got '$eventId'",
                    Exception::CODE_INVALID_ARG);
        }
        
        $result = $this->client->sendApiRequest("/events/$eventId");
        
        $event = new Event($result->getDecodedJsonData());
        $result->setPayload($event);
        
        return $result;
    }
    
    /**
     * Creates a new click event.
     * @param integer $pageId
     * @param ClickEvent $event
     * @return Result
     * @throws Exception
     */
    public function createClickEvent($pageId, $event)
    {
        if (!($event instanceOf ClickEvent)) {
            throw new Exception("Expected argument of type ClickEvent",
                    Exception::CODE_INVALID_ARG);
        }
        
        $postData = $event->toArray();
        
        $result = $this->client->sendApiRequest("/pages/$pageId/click_events", array(), 'POST', 
                $postData);
        
        $event = new ClickEvent($result->getDecodedJsonData());
        $result->setPayload($event);
        
        return $result;
    }
    
    /**
     * Creates a new custom event.
     * @param integer $pageId
     * @param CustomEvent $event
     * @return Result
     * @throws Exception
     */
    public function createCustomEvent($pageId, $event)
    {
        if (!($event instanceOf CustomEvent)) {
            throw new Exception("Expected argument of type CustomEvent",
                    Exception::CODE_INVALID_ARG);
        }
        
        $postData = $event->toArray();
        
        $result = $this->client->sendApiRequest("/pages/$pageId/custom_events", array(), 'POST', 
                $postData);
        
        $event = new CustomEvent($result->getDecodedJsonData());
        $result->setPayload($event);
        
        return $result;
    }
        
    /**
     * Updates the given click event.
     * @param integer $pageId
     * @param integer $eventId
     * @param ClickEvent $event
     * @return Result
     * @throws Exception
     */
    public function updateClickEvent($pageId, $eventId, $event) 
    {
        if (!($event instanceOf ClickEvent)) {
            throw new Exception("Expected argument of type ClickEvent",
                    Exception::CODE_INVALID_ARG);
        }
        
        $postData = $event->toArray();
                
        $result = $this->client->sendApiRequest("/pages/$pageId/click_events/$eventId", array(), 'PATCH', 
                $postData);
        
        $event = new ClickEvent($result->getDecodedJsonData());
        $result->setPayload($event);
        
        return $result;
    }
    
    /**
     * Updates the given custom event.
     * @param integer $pageId
     * @param integer $eventId
     * @param CustomEvent $event
     * @return Result
     * @throws Exception
     */
    public function updateCustomEvent($pageId, $eventId, $event) 
    {
        if (!($event instanceOf CustomEvent)) {
            throw new Exception("Expected argument of type CustomEvent",
                    Exception::CODE_INVALID_ARG);
        }
        
        $postData = $event->toArray();
                
        $result = $this->client->sendApiRequest("/pages/$pageId/custom_events/$eventId", array(), 'PATCH', 
                $postData);        
        
        $event = new CustomEvent($result->getDecodedJsonData());
        $result->setPayload($event);
        
        return $result;
    }
}





