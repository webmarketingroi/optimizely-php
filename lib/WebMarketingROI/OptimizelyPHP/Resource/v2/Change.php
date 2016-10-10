<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 10 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

/**
 * An Optimizely campaign change.
 */
class Change
{
    /**
     * The type of change to apply to the Page. Can be 'custom_code', 'custom_css', 
     * 'attribute', 'mobile_live_variable', 'mobile_code_block', 'mobile_visual_change', 
     * 'widget', 'insert_html', 'insert_image' or 'redirect'.
     * @var string 
     */
    private $type;
    
    /**
     * Indicates whether or not to execute the change asyncronously.
     * @var boolean
     */
    private $async;
    
    /**
     * A list of dependent change IDs that must happen before this change
     * @var array
     */
    private $dependencies;
    
    /**
     * The Page ID to apply changes to
     * @var string
     */
    private $src;
    
    /**
     * The value for the change
     * @var string
     */
    private $value;
    
    /**
     * The ID of the change
     * @var integer
     */
    private $id;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'type': $this->setType($value); break;
                case 'async': $this->setAsync($value); break;
                case 'dependencies': $this->setDependencies($value); break;
                case 'src': $this->setSrc($value); break;
                case 'value': $this->setValue($value); break;
                case 'id': $this->setId($value); break;
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
            'type' => $this->type,
            'async' => $this->async,
            'dependencies' => $this->dependencies,
            'src' => $this->src,
            'value' => $this->value,
            'id' => $this->id,            
        );
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
    }
    
    public function getAsync()
    {
        return $this->async;
    }
    
    public function setAsync($async)
    {
        $this->async = $async;
    }
    
    public function getDependencies()
    {
        return $this->dependencies;
    }
    
    public function setDependencies($dependencies)
    {
        $this->dependencies = $dependencies;
    }
    
    public function getSrc()
    {
        return $this->src;
    }
    
    public function setSrc($src)
    {
        $this->src = $src;
    }
    
    public function getValue()
    {
        return $this->value;
    }
    
    public function setValue($value)
    {
        $this->value = $value;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
}





