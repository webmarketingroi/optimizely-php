# optimizely-php

A PHP wrapper library for Optimizely REST API v2.0 (https://developers.optimizely.com/classic/rest/v2/)

## Installation

This library requires PHP 5.3+ engine with `curl` extension.

Installing with Composer:

`php composer.phar require webmarketingroi/optimizely-php`

## Usage

First, you need to create an instance of `OptimizelyApiClient` class. You do that
with the following lines of code:

```php
<?php
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;

try {

    // If you use "authorization code" grant, use the following array.
    $oauthCredentials = array(
        'client_id' => 'YOUR_CLIENT_ID',
        'client_secret' => 'YOUR_CLIENT_SECRET',
        'refresh_token' => 'YOUR_REFRESH_TOKEN',
        // Access token is optional (if not provided, will be retrieved automatically
        // with the refresh token.
        'access_token' => 'YOUR_ACCESS_TOKEN'
    );

    // Or, if you use "implicit grant", use the following array.
    $oauthCredentials = array(
        'access_token' => 'YOUR_ACCESS_TOKEN'
    );

    // Instantiate the API client.
    $client = new OptimizelyApiClient($oauthCredentials, 'v2');

    // Do something with the client.

    // ...

    // Finally, retrieve the access token from the client.
    $accessToken = $client->getAccessToken();
    
    // Save the access token somewhere (to file or database) for later use.
    $accessToken = json_encode($accessToken);
    file_put_contents('access_token.json', $accessToken);

} catch (\Exception $e) {
    // Handle errors.
    echo "Exception caught: " . $e->getMessage();
}
```

The first argument of client's constructor should be your Optimizely OAuth 
credentials in form of array, the second argument represents the API version 
(currently, only 'v2' is supported).

Note: For information on how to get OAuth 2.0 credentials, please refer to Optimizely
documentation https://developers.optimizely.com/classic/oauth/.

### Working with Projects

Use the following code to retrieve the first ten Optimizely projects:

```php

try {

    // Get the first 10 projects
    $page = 0;
    $projects = $client->projects()->listAll($page, 10);

    // Iterate through projects
    foreach ($projects as $project) {
        echo "Name: " . $project->getName() . "\n";
        echo "Description: " . $project->getDescription() . "\n";
    }

} catch (\Exception $e) {
    echo "Exception caught: " . $e->getMessage();
}
```

Note: If you have >10 projects, you should retrieve next pages of results by 
incrementing `$page` argument.

To add a new project, use the following code:

```php
<?php
use WebMarketingROI\OptimizelyPHP\Resource\v2\Project;

$project = new Project();
$project->setName('Test Project');
$project->setDescription('Some description');

$client->projects()->create($project);
```

## More Code Examples

For additional code examples, please refer to the *examples* directory.