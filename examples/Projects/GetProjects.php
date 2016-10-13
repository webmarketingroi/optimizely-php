<?php
/* 
 * This example retrieves all Optimizely projects from the Optimizely account.
 * 
 * To use this example, you will need to generate OAuth 2.0 access token and refresh 
 * token. See Optimizely REST API documentation for instructions on how to do that.
 * Once you get the OAuth 2.0 credentials, edit the auth_credentials.json file and put your 
 * access token and refresh token there.
 * 
 * Usage: 
 *      php GetProjects.php
 */
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;

// Init PHP autloader.
include dirname(__FILE__) . '/../../vendor/autoload.php';

// Get OAuth 2.0 credentials from file.
$credentials = file_get_contents(dirname(__FILE__) . '/../auth_credentials.json');
$credentials = json_decode($credentials, true);
if (!is_array($credentials)) {
    echo "Invalid auth credentials\n";
    exit;
}

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
$credentials = $optimizelyClient->getAuthCredentials();


echo "Done!";