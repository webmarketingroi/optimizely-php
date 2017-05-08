<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 08 May 2017
 * @copyright (c) 2017, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Service\v2;

use WebMarketingROI\OptimizelyPHP\Exception;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Attribute;

/**
 * Provides methods for working with Optimizely attributes.
 */
class Attributes
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
     * List Attributes under a Project
     * @param integer $projectId
     * @param integer $page
     * @param integer $perPage
     * @return Result
     * @throws Exception
     */
    public function listAll($projectId, $page=1, $perPage=25)
    {
        if ($page<0) {
            throw new Exception('Invalid page number passed');
        }
        
        if ($perPage<0 || $perPage>100) {
            throw new Exception('Invalid page size passed');
        }
        
        $result = $this->client->sendApiRequest('/attributes', 
                array(
                    'project_id'=>$projectId,
                    'page'=>$page,
                    'per_page'=>$perPage
                ));
        
        $attributes = array();
        foreach ($result->getDecodedJsonData() as $attributeInfo) {
            $attribute = new Attribute($attributeInfo);
            $attributes[] = $attribute;
        }
        $result->setPayload($attributes);
        
        return $result;
    }
    
    /**
     * Get Attribute by ID
     * @param type $attributeId
     * @return Result
     * @throws Exception
     */
    public function get($attributeId)
    {
        if (!is_int($attributeId)) {
            throw new Exception("Integer attribute ID expected, while got '$attributeId'",
                    Exception::CODE_INVALID_ARG);
        }
        
        $result = $this->client->sendApiRequest("/attributes/$attributeId");
        
        $attribute = new Attribute($result->getDecodedJsonData());
        $result->setPayload($attribute);
        
        return $result;
    }
    
    /**
     * Create an Attribue
     * @param Result
     */
    public function create($attribute)
    {
        if (!($attribute instanceOf \WebMarketingROI\OptimizelyPHP\Resource\v2\Attribute)) {
            throw new Exception("Expected argument of type Attribute",
                    Exception::CODE_INVALID_ARG);
        }
        
        $postData = $attribute->toArray();
        
        $result = $this->client->sendApiRequest("/attributes", array(), 'POST', 
                $postData, array(201));
        
        $attribute = new Attribute($result->getDecodedJsonData());
        $result->setPayload($attribute);
        
        return $result;
    }
    
    /**
     * Update an Attribute by ID
     * @param integer $attributeId     * 
     * @param Attribute $attribute
     * @return Result
     * @throws Exception
     */
    public function update($attributeId, $attribute) 
    {
        if (!($attribute instanceOf \WebMarketingROI\OptimizelyPHP\Resource\v2\Attribute)) {
            throw new Exception("Expected argument of type Attribute",
                    Exception::CODE_INVALID_ARG);
        }
        
        $postData = $attribute->toArray();
                
        $result = $this->client->sendApiRequest("/attributes/$attributeId", array(), 'PATCH', 
                $postData, array(200));
        
        $attribute = new Attribute($result->getDecodedJsonData());
        $result->setPayload($attribute);
        
        return $result;
    }
    
    /**
     * Delete Attribute by ID
     * @param integer $attributeId
     * @return Result
     * @throws Exception
     */
    public function delete($attributeId) 
    {
        $result = $this->client->sendApiRequest("/attributes/$attributeId", array(), 'DELETE', 
                array());
        
        return $result;
    }
}






