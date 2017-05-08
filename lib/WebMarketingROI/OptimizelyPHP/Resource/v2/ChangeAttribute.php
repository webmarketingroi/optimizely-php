<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 04 May 2017
 * @copyright (c) 2017, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;

/**
 * An Optimizely campaign change attributes.
 */
class ChangeAttribute
{
    /**
     * Name of the class to set the element(s) matched by a selector to
     * @var string
     */
    private $class;
    
    /**
     * Whether or not to hide the element(s) matched by a selector
     * @var boolean
     */
    private $hide;
    
    /**
     * Value of href attribute to add to element(s) matched by a selector
     * @var string
     */
    private $href;
    
    /**
     * Value of HTML attribute to add to element(s) matched by a selector
     * @var string
     */
    private $html;
    
    /**
     * Whether or not to remove the element(s) matched by a selector
     * @var boolean 
     */
    private $remove;
    
    /**
     * Value of src attribute to add to element(s) matched by a selector
     * @var string
     */
    private $src;
    
    /**
     * Value of style attribute to add to element(s) matched by a selector
     * @var string
     */
    private $style;
    
    /**
     * Value of text attribute to add to the element(s) matched by a selector
     * @var string
     */
    private $text;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'class': $this->setClass($value); break;
                case 'hide': $this->setHide($value); break;
                case 'href': $this->setHref($value); break;
                case 'html': $this->setHtml($value); break;
                case 'remove': $this->setRemove($value); break;
                case 'src': $this->setSrc($value); break;
                case 'style': $this->setStyle($value); break;
                case 'text': $this->setText($value); break;
                default:
                    throw new Exception('Unknown option found in the ChangeAttribute entity: ' . $name);
            }
        }
    }
    
    /**
     * Returns this object as array.
     */
    public function toArray()
    {
        $options = array(
            'class' => $this->getClass(),
            'hide' => $this->getHide(),
            'href' => $this->getHref(),
            'html' => $this->getHtml(),
            'remove' => $this->getRemove(),
            'src' => $this->getSrc(),
            'style' => $this->getStyle(),
            'text' => $this->getText(),
        );
        
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
    }
    
    public function getClass()
    {
        return $this->class;
    }
    
    public function setClass($class)
    {
        $this->class = $class;
    }
    
    public function getHide()
    {
        return $this->hide;
    }
    
    public function setHide($hide)
    {
        $this->hide = $hide;
    }
    
    public function getHref()
    {
        return $this->href;
    }
    
    public function setHref($href)
    {
        $this->href = $href;
    }
    
    public function getHtml()
    {
        return $this->html;
    }
    
    public function setHtml($html)
    {
        $this->html = $html;
    }
    
    public function getRemove()
    {
        return $this->remove;
    }
    
    public function setRemove($remove)
    {
        $this->remove = $remove;
    }
    
    public function getSrc()
    {
        return $this->src;
    }
    
    public function setSrc($src)
    {
        $this->src = $src;
    }
    
    public function getStyle()
    {
        return $this->style;
    }
    
    public function setStyle($style)
    {
        $this->style = $style;
    }
    
    public function getText()
    {
        return $this->text;
    }
    
    public function setText($text)
    {
        $this->text = $text;
    }
}





