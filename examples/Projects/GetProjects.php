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

// Init class autloading.
include dirname(__FILE__) . '/../../vendor/autoload.php';
include dirname(__FILE__) . '/../Utils.php';

// Get OAuth 2.0 credentials from auth_credentials.json and access_token.json files.
$credentials = load_credentials_from_file();

// Create the Optimizely API client.
$optimizelyClient = new OptimizelyApiClient($credentials, 'v2');

// Get projects.
echo "The list of Optimizely projects\n";
echo "===============================\n";
echo "\n";

$page = 0;
$perPage = 10;

for (;;) {
    try {
        $projects = $optimizelyClient->projects()->listAll($page, $perPage);
        
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
        
    } catch (\Exception $e) {
        echo "Exception caught: " . $e->getMessage() . "\n";
        break;
    }    
    
    $page ++;
}

// Save access token for later use
$accessToken = $optimizelyClient->getAccessToken();
file_put_contents(dirname(__FILE__) . '/../access_token.json', json_encode($accessToken));

echo "Done!";