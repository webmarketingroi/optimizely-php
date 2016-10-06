<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 06 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

/**
 * An Optimizely project.
 */
class Project
{
    private $name;
    
    private $accountId;
    
    private $dcpServiceId;
    
    private $platform;
    
    private $status;
    
    private $webSnippet;
    
    private $created;
    
    private $id;
    
    private $isClassic;
    
    private $lastModified;
    
    private $socketToken;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'name': $this->setName($value); break;
                case 'account_id': $this->setAccountId($value); break;
                case 'dcp_service_id': $this->setDcpServiceId($value); break;
                case 'platform': $this->setPlatform($value); break;
                case 'status': $this->setStatus($value); break;
                case 'web_snippet': $this->setWebSnippet($value); break;
                case 'created': $this->setCreated($value); break;
                case 'id': $this->setId($value); break;
                case 'is_classic': $this->setIsClassic($value); break;
                case 'last_modified': $this->setLastModified($value); break;
                case 'socket_token': $this->setSocketToken($value); break;
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
            'name' => $this->name,
            'account_id' => $this->accountId,
            'dcp_service_id' => $this->dcpServiceId,
            'platform' => $this->platform,
            'status' => $this->status,
            'web_snippet' => $this->webSnippet,
            'created' => $this->created,
            'id' => $this->id,
            'is_classic' => $this->isClassic,
            'last_modified' => $this->lastModified,
            'socket_token' => $this->socketToken
        );
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getAccountId()
    {
        return $this->accountId;
    }
    
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }
    
    public function getDcpServiceId()
    {
        return $this->dcpServiceId;
    }
    
    public function setDcpServiceId($dcpServiceId)
    {
        $this->dcpServiceId = $dcpServiceId;
    }
    
    public function getPlatform()
    {
        return $this->platform;
    }
    
    public function setPlatform($platform)
    {
        $this->platform = $platform;
    }
    
    public function getStatus()
    {
        return $this->status;
    }
    
    public function setStatus($status)
    {
        $this->status = $status;
    }
    
    public function getWebSnippet()
    {
        return $this->webSnippet;
    }
    
    public function setWebSnippet($webSnippet)
    {
        $this->webSnippet = $webSnippet;
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
    
    public function getIsClassic()
    {
        return $this->isClassic;
    }
    
    public function setIsClassic($isClassic)
    {
        $this->isClassic = $isClassic;
    }
    
    public function getLastModified()
    {
        return $this->lastModified;
    }
    
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;
    }
    
    public function getSocketToken()
    {
        return $this->socketToken;
    }
    
    public function setSocketToken($socketToken)
    {
        $this->socketToken = $socketToken;
    }
}



