<?php
/* 
 * This example creates a new experiment in the specified project in your Optimizely account.
 * 
 * To use this example, you will need to use "authorization code grant" and 
 * generate OAuth 2.0 client ID, client secret, refresh token, and, optionally,
 * access token. See Optimizely REST API documentation for instructions on how to do that.
 * Once you get the OAuth 2.0 credentials, edit the auth_credentials.json file 
 * and put your credentials there.
 * 
 * Usage: 
 *      php CreateExperiment.php <project_id>
 */

use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Exception;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Project;

// Init class autloading.
include dirname(__FILE__) . '/../../vendor/autoload.php';

// Include Utils.php - a file containing helper functions
include dirname(__FILE__) . '/../Utils.php';

// Get OAuth 2.0 credentials from auth_credentials.json and access_token.json files.
$credentials = load_credentials_from_file();

// Create the Optimizely API client.
$optimizelyClient = new OptimizelyApiClient($credentials, 'v2');

try {
    
    $project = new Experiment(array(
            "project_id" => 1000,
            "audience_ids" => array(
              1234,
              1212,
              1432
            ),
            "campaign_id" => 2000,
            "changes" => array(
              array(
                "type" => "custom_code",
                "allow_additional_redirect" => true,
                "async" => true,
                "css_selector" => "a[href*=\"optimizely\"]",
                "dependencies" => array(
                  24,
                  26
                ),
                "destination" => "https://app.optimizely.com/",
                "extension_id" => 1234,
                "preserve_parameters" => true,
                "src" => 524,
                "value" => "window.someGlobalFunction();"
              )
            ),
            "description" => "string",
            "holdback" => 5000,
            "key" => "home_page_experiment",
            "metrics" => array(
              array(
                "kind" => "string"
              )
            ),
            "name" => "Blue Button Experiment",
            "schedule" => array(
              "start_time" => "2016-10-17T07:04:59.724Z",
              "stop_time" => "2016-10-17T07:04:59.724Z",
              "time_zone" => "UTC"
            ),
            "status" => "active",
            "variations" => array(
              array(
                "actions" => array(
                  array(
                    "changes" => array(
                      array(
                        "type" => "custom_code",
                        "allow_additional_redirect" => true,
                        "async" => true,
                        "css_selector" => "a[href*=\"optimizely\"]",
                        "dependencies" => array(
                          24,
                          26
                        ),
                        "destination" => "https://app.optimizely.com/",
                        "extension_id" => 1234,
                        "preserve_parameters" => true,
                        "src" => 524,
                        "value" => "window.someGlobalFunction();"
                      )
                    ),
                    "page_id" => 0
                  )
                ),
                "archived" => true,
                "key" => "blue_button_variation",
                "name" => "Blue Button",
                "variation_id" => 0,
                "weight" => 0
              )
            )
        ));
        
    $result = $optimizelyClient->experiments()->create($experiment);
    $createdExperiment = $result->getPayload();
                
} catch (Exception $e) {
    // Handle error.
    $code = $e->getCode();
    $httpCode = $e->getHttpCode();
    $message = $e->getMessage();
    $uuid = $e->getUuid();
    echo "Exception caught: $message (code=$code http_code=$httpCode uuid=$uuid)\n";
}    

// Save access token for later use
$accessToken = $optimizelyClient->getAccessToken();
file_put_contents(dirname(__FILE__) . '/../access_token.json', json_encode($accessToken));

echo "Done!\n";