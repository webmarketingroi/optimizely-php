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

$oauthCredentials = array(
    'client_id' => 'YOUR_CLIENT_ID',
    'client_secret' => 'YOUR_CLIENT_SECRET',
    'refresh_token' => 'YOUR_REFRESH_TOKEN',
    // Access token is optional (if not provided, will be retrieved automatically
    // with the refresh token.
    'access_token' => 'YOUR_ACCESS_TOKEN'
);

$client = new OptimizelyApiClient($oauthCredentials, 'v2');
```

The first argument of client's constructor should be your Optimizely OAuth 
credentials in form of array, the second argument represents the API version 
(currently, only 'v2' is supported).

Note: For information on how to get OAuth 2.0 credentials, please refer to Optimizely
documentation https://developers.optimizely.com/classic/oauth/.

### Working with Projects

Use the following code to retrieve first ten Optimizely projects:

```php
// Get the first 10 projects
$page = 0;
$projects = $client->projects()->listAll($page, 10);

// Iterate through projects
foreach ($projects as $project) {
    echo "Name: " . $project->getName() . "\n";
    echo "Description: " . $project->getDescription() . "\n";
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

