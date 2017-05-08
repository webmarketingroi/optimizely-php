<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 04 May 2017
 * @copyright (c) 2017, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;

/**
 * An Optimizely CSS attribute.
 */
class CssAttribute
{        
    private $backgroundColor;
 
    private $backgroundImage;
    
    private $borderColor;
    
    private $borderStyle;
    
    private $borderWidth;
    
    private $color;
    
    private $fontSize;
    
    private $fontWeight;
    
    private $height;
    
    private $position;
    
    private $width;
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'background-color': $this->setBackgroundColor($value); break;
                case 'background-image': $this->setBackgroundImage($value); break;
                case 'border-color': $this->setBorderColor($value); break;
                case 'border-style': $this->setBorderStyle($value); break;
                case 'border-width': $this->setBorderWidth($value); break;
                case 'color': $this->setColor($value); break;
                case 'font-size': $this->setFontSize($value); break;
                case 'font-weight': $this->setFontWeight($value); break;
                case 'height': $this->setHeight($value); break;
                case 'position': $this->setPosition($value); break;
                case 'width': $this->setWidth($value); break;
                default:
                    throw new Exception('Unknown option found in the CssAttribute entity: ' . $name);
            }
        }
    }
    
    /**
     * Returns this object as array.
     */
    public function toArray()
    {
        $options = array(
            'background-color' => $this->getBackgroundColor(),
            'background-image' => $this->getBackgroundImage(),
            'border-color' => $this->getBorderColor(),
            'border-style' => $this->getBorderStyle(),
            'border-width' => $this->getBorderWidth(),
            'color' => $this->getColor(),
            'font-size' => $this->getFontSize(),
            'font-weight' => $this->getFontWeight(),
            'height' => $this->getHeight(),
            'position' => $this->getPosition(),
            'width' => $this->getWidth(),
        );
        
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
    }
    
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }
    
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;
    }
    
    public function getBackgroundImage()
    {
        return $this->backgroundImage;
    }
    
    public function setBackgroundImage($backgroundImage)
    {
        $this->backgroundImage = $backgroundImage;
    }
    
    public function getBorderColor()
    {
        return $this->borderColor;
    }
    
    public function setBorderColor($borderColor)
    {
        $this->borderColor = $borderColor;
    }
    
    public function getBorderStyle()
    {
        return $this->borderStyle;
    }
    
    public function setBorderStyle($borderStyle)
    {
        $this->borderStyle = $borderStyle;
    }
    
    public function getBorderWidth()
    {
        return $this->borderWidth;
    }
    
    public function setBorderWidth($borderWidth)
    {
        $this->borderWidth = $borderWidth;
    }
    
    public function getColor()
    {
        return $this->color;
    }
    
    public function setColor($color)
    {
        $this->color = $color;
    }
    
    public function getFontSize()
    {
        return $this->fontSize;
    }
    
    public function setFontSize($fontSize)
    {
        $this->fontSize = $fontSize;
    }
    
    public function getFontWeight()
    {
        return $this->fontWeight;
    }
    
    public function setFontWeight($fontWeight)
    {
        $this->fontWeight = $fontWeight;
    }
    
    public function getHeight()
    {
        return $this->height;
    }
    
    public function setHeight($height)
    {
        $this->height = $height;
    }
    
    public function getPosition()
    {
        return $this->position;
    }
    
    public function setPosition($position)
    {
        $this->position = $position;
    }
    
    public function getWidth()
    {
        return $this->width;
    }
    
    public function setWidth($width)
    {
        $this->width = $width;
    }
}







