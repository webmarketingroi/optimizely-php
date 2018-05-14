<?php
/* 
 * This example creates a new campaign in the specified project in your Optimizely account.
 * 
 * To use this example, you will need to use "authorization code grant" and 
 * generate OAuth 2.0 client ID, client secret, refresh token, and, optionally,
 * access token. See Optimizely REST API documentation for instructions on how to do that.
 * Once you get the OAuth 2.0 credentials, edit the auth_credentials.json file 
 * and put your credentials there.
 * 
 * Usage: 
 *      php CreateCampaign.php <project_id> <page_id>
 */

use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Exception;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Campaign;

// Init class autloading.
include dirname(__FILE__) . '/../../vendor/autoload.php';

// Include Utils.php - a file containing helper functions
include dirname(__FILE__) . '/../Utils.php';

// Read project ID from command line.
if ($argc!=3) {
    die('Expected 2 command-line argument, while got ' . $argc-1);
}

$projectId = $argv[1];

$pageId = $argv[2];

// Get OAuth 2.0 credentials from auth_credentials.json and access_token.json files.
$credentials = load_credentials_from_file();

// Create the Optimizely API client.
$optimizelyClient = new OptimizelyApiClient($credentials, 'v2');

try {
    
    $campaign = new Campaign(array(
            "project_id" => $projectId,
            "changes" => array(
              array(
                "type" => "custom_code",
                "value" => "window.someGlobalFunction();"
              )
            ),
            "experiment_ids" => array(
              0
            ),
            "holdback" => 0,
            "metrics" => array(
              array(
                "aggregator" => "sum",
                "event_id" => 0,
                "field" => "revenue",
                "scope" => "session"
              )
            ),
            "name" => "Landing Page Optimization",
            "page_ids" => array(
              $pageId,
            ),
            "status" => "not_started",
            "type" => "a/b"
        ));
        
    $result = $optimizelyClient->campaigns()->create($campaign);
    $createdCampaign = $result->getPayload();
                
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
