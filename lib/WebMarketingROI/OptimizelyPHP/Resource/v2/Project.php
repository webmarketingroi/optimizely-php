<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 06 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Resource\v2\WebSnippet;

/**
 * An Optimizely project.
 */
class Project
{
    /**
     * The name of the project
     * @var string 
     */
    private $name;
    
    /**
     * The account the project is associated with
     * @var integer 
     */
    private $accountId;
    
    /**
     * The significance level at which you would like to declare winning and 
     * losing variations. A lower number minimizes the time needed to declare a 
     * winning or losing variation, but increases the risk that your results 
     * aren't true winners and losers. The precision for this number is up to 4 
     * decimal places.
     * 
     * @var number 
     */
    private $confidenceThreshold;
    
    /**
     * The ID of a Dynamic Customer Profile Service associated with this project.
     * @var integer 
     */
    private $dcpServiceId;
    
    /**
     * The platform of the project. Can be 'web', 'ios', 'android' or 'custom'.
     * @var string 
     */
    private $platform;
    
    /**
     * The current status of the project. Can be 'active' or 'archived'.
     * @var string 
     */
    private $status;
    
    /**
     * Web snippet-specific configuration for this project.
     * @var WebSnippet 
     */
    private $webSnippet;
    
    /**
     * The time that the project was originally created
     * @var string 
     */
    private $created;
    
    /**
     * The unique identifier for the project.
     * @var integer 
     */
    private $id;
    
    /**
     * Whether or not this project was created under Optimizely Classic.
     * @var boolean 
     */
    private $isClassic;
    
    /**
     * The time the project was last modified
     * @var string 
     */
    private $lastModified;
    
    /**
     * The token used to identify your mobile app to Optimizely. (mobile only)
     * @var string 
     */
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
                case 'confidence_threshold': $this->setConfidenceThreshold($value); break;
                case 'dcp_service_id': $this->setDcpServiceId($value); break;
                case 'platform': $this->setPlatform($value); break;
                case 'status': $this->setStatus($value); break;
                case 'web_snippet': {
                    $webSnippet = new WebSnippet($value);
                    $this->setWebSnippet($webSnippet); 
                    break;
                }
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
        $options = array(
            'name' => $this->getName(),
            'account_id' => $this->getAccountId(),
            'confidence_threshold' => $this->getConfidenceThreshold(),
            'dcp_service_id' => $this->getDcpServiceId(),
            'platform' => $this->getPlatform(),
            'status' => $this->getStatus(),
            'web_snippet' => $this->getWebSnippet()?$this->getWebSnippet()->toArray():null,
            'created' => $this->getCreated(),
            'id' => $this->getId(),
            'is_classic' => $this->getIsClassic(),
            'last_modified' => $this->getLastModified(),
            'socket_token' => $this->getSocketToken()
        );
        
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
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
    
    public function getConfidenceThreshold()
    {
        return $this->confidenceThreshold;
    }
    
    public function setConfidenceThreshold($confidenceThreshold)
    {
        $this->confidenceThreshold = $confidenceThreshold;
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



