<?php
/* 
 * This example retrieves all projects from the Optimizely account.
 * 
 * To use this example, you will need to use "authorization code grant" and 
 * generate OAuth 2.0 client ID, client secret, refresh token, and, optionally,
 * access token. See Optimizely REST API documentation for instructions on how to do that.
 * Once you get the OAuth 2.0 credentials, edit the auth_credentials.json file 
 * and put your credentials there.
 * 
 * Usage: 
 *      php GetProjects.php
 */

use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Exception;

// Init class autloading.
include dirname(__FILE__) . '/../../vendor/autoload.php';

// Include Utils.php - a file containing helper functions
include dirname(__FILE__) . '/../Utils.php';

// Get OAuth 2.0 credentials from auth_credentials.json and access_token.json files.
$credentials = load_credentials_from_file();

// Create the Optimizely API client.
$optimizelyClient = new OptimizelyApiClient($credentials, 'v2');

// Get projects.
echo "The list of Optimizely projects\n";
echo "===============================\n";
echo "\n";

$page = 1;

try {
    
    for (;;) {
    
        $result = $optimizelyClient->projects()->listAll($page, 25);
        $projects = $result->getPayload();
        
        foreach ($projects as $project) {
            echo "ID: " . $project->getId() . "\n";
            echo "Name: " . $project->getName() . "\n";
            echo "Account ID: " . $project->getAccountId() . "\n";
            echo "Platform: " . $project->getPlatform() . "\n";
            echo "Status: " . $project->getStatus() . "\n";
            echo "Is Classic: " . ($project->getIsClassic()?"true":"false") . "\n";
            echo "Created: " . $project->getCreated() . "\n";
            echo "Last Modified: " . $project->getLastModified() . "\n";
            
            echo "\n";
        }
        
        // Determine if there are more projects.
        if ($result->getNextPage()==null)
            break;
        
        // Increment page counter.
        $page ++;
    }
        
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