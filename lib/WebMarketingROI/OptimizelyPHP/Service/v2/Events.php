<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 07 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Service\v2;

use WebMarketingROI\OptimizelyPHP\Resource\v2\Event;

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
     * Creates a new click or custom event.
     * @param integer $pageId
     * @param Event $event
     */
    public function create($pageId, $event)
    {
        if (!($event instanceOf \WebMarketingROI\OptimizelyPHP\Resource\v2\Event)) {
            throw new \Exception("Expected argument of type Event");
        }
        
        $postData = $event->toArray();
        
        $response = $this->client->sendApiRequest("/pages/$pageId/click_events", array(), 'POST', 
                $postData, array(201));
    }
        
    /**
     * Updates the given event (either click event or custom event).
     * @param integer $pageId
     * @param integer $eventId
     * @param Event $event
     * @throws \Exception
     */
    public function update($pageId, $eventId, $event) 
    {
        if (!($audience instanceOf \WebMarketingROI\OptimizelyPHP\Resource\v2\Event)) {
            throw new \Exception("Expected argument of type Event");
        }
        
        $postData = $event->toArray();
                
        $response = $this->client->sendApiRequest("/pages/$pageId/click_events/$eventId", array(), 'PATCH', 
                $postData, array(200));
    }
}





