<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 07 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Service\v2;

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
     * @return array[Event]
     * @throws \Exception
     */
    public function listAll($projectId, $includeClassic, $page=0, $perPage=10)
    {
        if ($page<0) {
            throw new \Exception('Invalid page number passed');
        }
        
        if ($perPage<0) {
            throw new \Exception('Invalid page size passed');
        }
        
        $response = $this->client->sendApiRequest('/events', 
                array(
                    'project_id'=>$projectId,
                    'include_classic'=>$includeClassic,
                    'page'=>$page,
                    'per_page'=>$perPage
                ));
        
        $events = array();
        foreach ($response as $eventInfo) {
            $event = new Event($eventInfo);
            $events[] = $event;
        }
        
        return $events;
    }
    
    /**
     * Get Event by ID
     * @param type $eventId
     * @return Event
     * @throws \Exception
     */
    public function get($eventId)
    {
        if (!is_int($eventId)) {
            throw new \Exception("Integer event ID expected, while got '$eventId'");
        }
        
        $response = $this->client->sendApiRequest("/events/$eventId");
        
        $event = new Event($response);
        
        return $event;
    }
    
    /**
     * Creates a new click event.
     * @param integer $pageId
     * @param ClickEvent $event
     */
    public function createClickEvent($pageId, $event)
    {
        if (!($event instanceOf ClickEvent)) {
            throw new \Exception("Expected argument of type ClickEvent");
        }
        
        $postData = $event->toArray();
        
        $response = $this->client->sendApiRequest("/pages/$pageId/click_events", array(), 'POST', 
                $postData, array(201));
        
        return new ClickEvent($response);
    }
    
    /**
     * Creates a new custom event.
     * @param integer $pageId
     * @param CustomEvent $event
     */
    public function createCustomEvent($pageId, $event)
    {
        if (!($event instanceOf CustomEvent)) {
            throw new \Exception("Expected argument of type CustomEvent");
        }
        
        $postData = $event->toArray();
        
        $response = $this->client->sendApiRequest("/pages/$pageId/custom_events", array(), 'POST', 
                $postData, array(201));
        
        return new CustomEvent($response);
    }
        
    /**
     * Updates the given click event.
     * @param integer $pageId
     * @param integer $eventId
     * @param ClickEvent $event
     * @throws \Exception
     */
    public function updateClickEvent($pageId, $eventId, $event) 
    {
        if (!($event instanceOf ClickEvent)) {
            throw new \Exception("Expected argument of type ClickEvent");
        }
        
        $postData = $event->toArray();
                
        $response = $this->client->sendApiRequest("/pages/$pageId/click_events/$eventId", array(), 'PATCH', 
                $postData, array(200));
        
        return new ClickEvent($response);
    }
    
    /**
     * Updates the given custom event.
     * @param integer $pageId
     * @param integer $eventId
     * @param CustomEvent $event
     * @throws \Exception
     */
    public function updateCustomEvent($pageId, $eventId, $event) 
    {
        if (!($event instanceOf CustomEvent)) {
            throw new \Exception("Expected argument of type CustomEvent");
        }
        
        $postData = $event->toArray();
                
        $response = $this->client->sendApiRequest("/pages/$pageId/custom_events/$eventId", array(), 'PATCH', 
                $postData, array(200));
        
        return new CustomEvent($response);
    }
}





