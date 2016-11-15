<?php
/**
 * @author Oleg Krivtsov <oleg@webmarketingroi.com.au>
 * @date 10 October 2016
 * @copyright (c) 2016, Web Marketing ROI
 */
namespace WebMarketingROI\OptimizelyPHP\Resource\v2;

use WebMarketingROI\OptimizelyPHP\Exception;

/**
 * An Optimizely web snippet configuration.
 */
class WebSnippet
{
    /**
     * Enables the option to force yourself into a specific Variation on any page
     * @var boolean 
     */
    private $enableForceVariation;
    
    /**
     * Set to true to remove paused and draft experiments from the snippet
     * @var boolean 
     */
    private $excludeDisabledExperiments;
    
    /**
     * Set to true to mask descriptive names
     * @var boolean
     */
    private $excludeNames;
    
    /**
     * Set to true to include jQuery in your snippet.
     * @var boolean 
     */
    private $includeJquery;
    
    /**
     * Set to true to change the last octet of IP addresses to 0 prior to logging
     * @var boolean 
     */
    private $ipAnonymization;
    
    /**
     * A regular expression (max 1500 characters) matching ip addresses for 
     * filtering out visitors. Matching visitors will still see the experiments, 
     * but they won't be counted in results.
     * @var string 
     */
    private $ipFilter;
    
    /**
     * The prefered jQuery library version you would like to use with your snippet. 
     * If you do not want to include jQuery, set include_jquery to false. Can be 
     * 'jquery-1.11.3-trim', 'jquery-1.11.3-full', 'jquery-1.6.4-trim', 'jquery-1.6.4-full' 
     * or 'none'.
     * @var string 
     */
    private $library;
    
    /**
     * The javascript code which runs before Optimizely on all pages, regardless 
     * of whether or not there is a running experiment.
     * @var string
     */
    private $projectJavascript;
    
    /**
     * The current revision number of the project snippet
     * @var integer 
     */
    private $codeRevision;
    
    /**
     * The current size in bytes of the project snippet
     * @var integer 
     */
    private $jsFileSize;
    
    
    /**
     * Constructor.
     */
    public function __construct($options = array())
    {
        foreach ($options as $name=>$value) {
            switch ($name) {                
                case 'enable_force_variation': $this->setEnableForceVariation($value); break;
                case 'exclude_disabled_experiments': $this->setExcludeDisabledExperiments($value); break;
                case 'exclude_names': $this->setExcludeNames($value); break;
                case 'include_jquery': $this->setIncludeJquery($value); break;
                case 'ip_anonymization': $this->setIpAnonymization($value); break;
                case 'ip_filter': $this->setIpFilter($value); break;
                case 'library': $this->setLibrary($value); break;
                case 'project_javascript': $this->setProjectJavascript($value); break;
                case 'code_revision': $this->setCodeRevision($value); break;
                case 'js_file_size': $this->setJsFileSize($value); break;
                default:
                    throw new Exception('Unknown option: ' . $name);
            }
        }
    }
    
    /**
     * Returns this object as array.
     */
    public function toArray()
    {
        $options = array(
            'enable_force_variation' => $this->enableForceVariation,
            'exclude_disabled_experiments' => $this->excludeDisabledExperiments,
            'exclude_names' => $this->excludeNames,
            'include_jquery' => $this->includeJquery,
            'ip_anonymization' => $this->ipAnonymization,
            'ip_filter' => $this->ipFilter,
            'library' => $this->library,
            'project_javascript' => $this->projectJavascript,
            'code_revision' => $this->codeRevision,
            'js_file_size' => $this->jsFileSize
        );
        
        // Remove options with empty values
        $cleanedOptions = array();
        foreach ($options as $name=>$value) {
            if ($value!==null)
                $cleanedOptions[$name] = $value;
        }
        
        return $cleanedOptions;
    }
    
    public function getEnableForceVariation()
    {
        return $this->enableForceVariation;
    }
    
    public function setEnableForceVariation($enableForceVariation)
    {
        $this->enableForceVariation = $enableForceVariation;
    }
    
    public function getExcludeDisabledExperiments()
    {
        return $this->excludeDisabledExperiments;
    }
    
    public function setExcludeDisabledExperiments($excludeDisabledExperiments)
    {
        $this->excludeDisabledExperiments = $excludeDisabledExperiments;
    }
    
    public function getExcludeNames()
    {
        return $this->excludeNames;
    }
    
    public function setExcludeNames($excludeNames)
    {
        $this->excludeNames = $excludeNames;
    }
    
    public function getIncludeJquery()
    {
        return $this->includeJquery;
    }
    
    public function setIncludeJquery($includeJquery)
    {
        $this->includeJquery = $includeJquery;
    }
        
    public function getIpAnonymization()
    {
        return $this->ipAnonymization;
    }
    
    public function setIpAnonymization($ipAnonymization)
    {
        $this->ipAnonymization = $ipAnonymization;
    }
        
    public function getIpFilter()
    {
        return $this->ipFilter;
    }
    
    public function setIpFilter($ipFilter)
    {
        $this->ipFilter = $ipFilter;
    }
    
    public function getLibrary()
    {
        return $this->library;
    }
    
    public function setLibrary($library)
    {
        $this->library = $library;
    }
    
    public function getProjectJavascript()
    {
        return $this->projectJavascript;
    }
    
    public function setProjectJavascript($projectJavascript)
    {
        $this->projectJavascript = $projectJavascript;
    }
    
    public function getCodeRevision()
    {
        return $this->codeRevision;
    }
    
    public function setCodeRevision($codeRevision)
    {
        $this->codeRevision = $codeRevision;
    }
    
    public function getJsFileSize()
    {
        return $this->jsFileSize;
    }
    
    public function setJsFileSize($jsFileSize)
    {
        $this->jsFileSize = $jsFileSize;
    }
}








