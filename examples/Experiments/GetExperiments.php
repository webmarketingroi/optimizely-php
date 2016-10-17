<?php
/* 
 * This example retrieves all experiments for the given project from the Optimizely account.
 * 
 * To use this example, you will need to use "authorization code grant" and 
 * generate OAuth 2.0 client ID, client secret, refresh token, and, optionally,
 * access token. See Optimizely REST API documentation for instructions on how to do that.
 * Once you get the OAuth 2.0 credentials, edit the auth_credentials.json file 
 * and put your credentials there.
 * 
 * Usage: 
 *      php GetExperiments.php <project_id>
 */

use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;

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

// Get projects.
echo "The list of Optimizely experiments\n";
echo "==================================\n";
echo "\n";

$page = 0;
$perPage = 10;

for (;;) {
    try {
        $experiments = $optimizelyClient->experiments()->listAll($projectId, null, true, $page, $perPage);
        
        foreach ($experiments as $experiment) {
            echo "Name: " . $experiment->getName() . "\n";
            echo "Description: " . $experiment->getDescription() . "\n";
            echo "Status: " . $project->getStatus() . "\n";
            echo "Created: " . $project->getCreated() . "\n";
            
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

echo "Done!\n";
