# optimizely-php

[![Build Status](https://travis-ci.org/webmarketingroi/optimizely-php.svg?branch=master)](http://travis-ci.org/webmarketingroi/optimizely-php) [![Code Coverage](https://scrutinizer-ci.com/g/webmarketingroi/optimizely-php/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/webmarketingroi/optimizely-php/?branch=master) [![Latest Stable Version](https://poser.pugx.org/webmarketingroi/optimizely-php/v/stable.svg)](https://packagist.org/packages/webmarketingroi/optimizely-php) [![Total Downloads](https://poser.pugx.org/webmarketingroi/optimizely-php/downloads.svg)](https://packagist.org/packages/webmarketingroi/optimizely-php) [![Latest Unstable Version](https://poser.pugx.org/webmarketingroi/optimizely-php/v/unstable.svg)](https://packagist.org/packages/webmarketingroi/optimizely-php)

A PHP wrapper library for Optimizely REST API v2.0 (https://developers.optimizely.com/rest/v2/)

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
    file_put_contents('access_token.json', json_encode($accessToken));

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

#### Getting List of Projects

Use the following code to retrieve the first ten Optimizely projects:

```php
// Get the first 10 projects
$page = 0;
$projects = $client->projects()->listAll($page, 10);

// Iterate through projects
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
```

Note: If you have >10 projects, you should retrieve next pages of results by 
incrementing `$page` argument.

#### Adding New Project

To add a new project, use the following code:

```php
<?php
use WebMarketingROI\OptimizelyPHP\Resource\v2\Project;

$project = new Project();
$project->setName('Test Project');
$project->setConfidenceThreshold(0.9);
$project->setPlatform('web');
$project->setStatus('active');

$createdProject = $client->projects()->create($project);
```

or, you can use this (equavalent) code:

```php
<?php
use WebMarketingROI\OptimizelyPHP\Resource\v2\Project;

$project = new Project(array(
        'name' => 'Test Project',
        'confidence_threshold' => 0.9,
        'platform' => 'web',
        'status' => 'active'
    ));

// On return, $createdProject variable will contain the data of newly created project
$createdProject = $client->projects()->create($project);
```

#### Updating Existing Project

```php
<?php

// We assume that $project is of type Project and that you retrieved it earlier
$project->setName('New Project Name');

// On return, $updatedProject variable will contain the data of project you just updated
$updatedProject = $client->projects()->update($project);
```

### More Code Examples

For additional code examples, please refer to the *examples* directory.

## Running Unit Tests

This library uses PHPUnit for testing. To run unit tests, use the following command:

```
./vendor/bin/phpunit -c ./tests/phpunit.xml --coverage-html coverage
```

If you want to run integration tests against real Optimizely account, rename 
`tests/auth_credentials.json.dist` to `tests/auth_credentials.json` and type
your credentials in that file. Then create the `OPTIMIZELY_PHP_TEST_INTEGRATION` 
environment variable as follows

`export OPTIMIZELY_PHP_TEST_INTEGRATION=1`

and then run unit tests.
