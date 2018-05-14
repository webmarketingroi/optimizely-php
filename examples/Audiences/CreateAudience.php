<?php
/* 
 * This example creates a new audience in the specified project in your Optimizely account.
 * 
 * To use this example, you will need to use "authorization code grant" and 
 * generate OAuth 2.0 client ID, client secret, refresh token, and, optionally,
 * access token. See Optimizely REST API documentation for instructions on how to do that.
 * Once you get the OAuth 2.0 credentials, edit the auth_credentials.json file 
 * and put your credentials there.
 * 
 * Usage: 
 *      php CreateAudience.php <project_id>
 */

use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Exception;
use WebMarketingROI\OptimizelyPHP\Resource\v2\Audience;

// Init class autloading.
include dirname(__FILE__) . '/../../vendor/autoload.php';

// Include Utils.php - a file containing helper functions
include dirname(__FILE__) . '/../Utils.php';

// Read project ID from command line.
if ($argc!=2) {
    die('Expected 1 command-line argument, while got ' . $argc-1);
}

$projectId = $argv[1];

// Get OAuth 2.0 credentials from auth_credentials.json and access_token.json files.
$credentials = load_credentials_from_file();

// Create the Optimizely API client.
$optimizelyClient = new OptimizelyApiClient($credentials, 'v2');

try {
    $audience = new Audience(array(
            "project_id" => $projectId,
            "archived" => false,
            "conditions" => "[\"and\", {\"type\": \"language\", \"value\": \"es\"}, {\"type\": \"location\", \"value\": \"US\"}]",
            "description" => "People that speak spanish and are in San Francisco",
            "name" => "Spanish speaking San Franciscans",
            "segmentation" => true
        ));
        
    $result = $optimizelyClient->audiences()->create($audience);
    $createdAudience = $result->getPayload();
                
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
