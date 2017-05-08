<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 10 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;

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
     * Whether or not to allow additional redirects after redirecting to 
     * destination. Required for changes of type redirect.
     * @var boolean
     */
    private $allowAdditionalRedirect;
    
    /**
     * Indicates whether or not to execute the change asyncronously.
     * @var boolean
     */
    private $async;
    
    /**
     * CSS selector to determine where changes are applied. Required for changes 
     * of type custom_css, insert_html and insert_image.
     * @var string
     */
    private $cssSelector;
    
    /**
     * A list of dependent change IDs that must happen before this change
     * @var array[string]
     */
    private $dependencies;
    
    /**
     * URL to redirect to. Required for changes of type redirect.
     * @var string 
     */
    private $destination;
    
    /**
     * ID of the extension to insert. Required for changes of type extension.
     * @var string
     */
    private $extensionId;
    
    /**
     * Whether or not to preserve parameters from original request when 
     * redirecting to new destination URL. Required for changes of type redirect.
     * @var boolean 
     */
    private $preserveParameters;
    
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
     * CSS selector to determine where changes are applied. Required for changes 
     * of type 'attribute', 'insert_html', and 'insert_image'
     * @var string
     */
    private $selector;
    
    /**
     * New value(s) for the element(s) matched by 'selector'. This field is only 
     * applicable to changes of type 'attribute'.
     * @var ChangeAttribute
     */
    private $attributes;
    
    /**
     * A directive to place the DOM element(s) matched by 'selector' to the position 
     * of the element matched by 'insertSelector', with the relation specified by 
     * 'operator'. The supplied example moves element matched by 'selector' above the element of class .greyBox
     * @var array
     */
    private $rearrange;
    
    /**
     * Configuration properties for the extension
     * @var array
     */
    private $config;
    
    /**
     * CSS to apply to element(s) matched by 'selector'.
     * @var CssAttribute
     */
    private $css;
    
    /**
     * Name of the change
     * @var string
     */
    private $name;
    
    /**
     * Where to instert HTML or image for types 'insert_html' and 'insert_image' 
     * with respect to the element(s) matched by 'selector'
     * @var string
     */
    private $operator;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'type': $this->setType($value); break;
                case 'allow_additional_redirect': $this->setAllowAdditionalRedirect($value); break;
                case 'async': $this->setAsync($value); break;                
                case 'dependencies': $this->setDependencies($value); break;
                case 'destination': $this->setDestination($value); break;
                case 'extension_id': $this->setExtensionId($value); break;
                case 'preserve_parameters': $this->setPreserveParameters($value); break;
                case 'src': $this->setSrc($value); break;
                case 'value': $this->setValue($value); break;
                case 'id': $this->setId($value); break;
                case 'selector': $this->setSelector($value); break;
                case 'attributes': 
                    $attrs = new ChangeAttribute($value);                    
                    $this->setAttributes($attrs); 
                    break;
                case 'rearrange': $this->getRearrange($value); break;    
                case 'config': $this->setConfig($value); break;                
                case 'css': 
                    $attr = new CssAttribute($value);
                    $this->setCss($attr); break;                
                case 'name': $this->setName($value); break;                
                case 'operator': $this->setOperator($value); break;                
                default:
                    throw new Exception('Unknown option found in the Change entity: ' . $name);
            }
        }
    }
    
    /**
     * Returns this object as array.
     */
    public function toArray()
    {
        $options = array(
            'type' => $this->getType(),
            'allow_additional_redirect' => $this->getAllowAdditionalRedirect(),
            'async' => $this->getAsync(),
            'dependencies' => $this->getDependencies(),
            'destination' => $this->getDestination(),
            'extension_id' => $this->getExtensionId(),
            'preserve_parameters' => $this->getPreserveParameters(),
            'src' => $this->getSrc(),
            'value' => $this->getValue(),
            'id' => $this->getId(),            
            'selector' => $this->getSelector(),
            'attributes' => $this->getAttributes()?$this->getAttributes()->toArray():null,
            'rearrange' => $this->getRearrange(),
            'config' => $this->getConfig(),
            'css' => $this->getCss()?$this->getCss()->toArray():null,
            'name' => $this->getName(),
            'operator' => $this->getOperator(),
        );
        
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
    }
    
    public function getAllowAdditionalRedirect()
    {
        return $this->allowAdditionalRedirect;
    }
    
    public function setAllowAdditionalRedirect($allowAdditionalRedirect)
    {
        $this->allowAdditionalRedirect = $allowAdditionalRedirect;
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
    
    public function getDestination()
    {
        return $this->destination;
    }
    
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }
    
    public function getExtensionId()
    {
        return $this->extensionId;
    }
    
    public function setExtensionId($extensionId)
    {
        $this->extensionId = $extensionId;
    }
    
    public function getPreserveParameters()
    {
        return $this->preserveParameters;
    }
    
    public function setPreserveParameters($preserveParameters)
    {
        $this->preserveParameters = $preserveParameters;
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
    
    public function getSelector()
    {
        return $this->selector;
    }
    
    public function setSelector($selector)
    {
        $this->selector = $selector;
    }
    
    public function getAttributes()
    {
        return $this->attributes;
    }
    
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }
    
    public function getRearrange()
    {
        return $this->rearrange;
    }
    
    public function setRearrange($rearrange)
    {
        $this->rearrange = $rearrange;
    }
    
    public function getConfig()
    {
        return $this->config;
    }
    
    public function setConfig($config)
    {
        $this->config = $config;
    }
    
    public function getCss()
    {
        return $this->css;
    }
    
    public function setCss($css)
    {
        $this->css = $css;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getOperator()
    {
        return $this->operator;
    }
    
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }
}





