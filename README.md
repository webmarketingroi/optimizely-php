# optimizely-php

[![Build Status](https://travis-ci.org/webmarketingroi/optimizely-php.svg?branch=master)](http://travis-ci.org/webmarketingroi/optimizely-php) 
[![Code Coverage](https://scrutinizer-ci.com/g/webmarketingroi/optimizely-php/badges/coverage.png)](https://scrutinizer-ci.com/g/webmarketingroi/optimizely-php/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/webmarketingroi/optimizely-php/v/stable.svg)](https://packagist.org/packages/webmarketingroi/optimizely-php) 
[![Total Downloads](https://poser.pugx.org/webmarketingroi/optimizely-php/downloads.svg)](https://packagist.org/packages/webmarketingroi/optimizely-php) 
[![Latest Unstable Version](https://poser.pugx.org/webmarketingroi/optimizely-php/v/unstable.svg)](https://packagist.org/packages/webmarketingroi/optimizely-php)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/webmarketingroi/optimizely-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/webmarketingroi/optimizely-php/?branch=master)

A PHP wrapper library for the Optimizely REST API v2.0 (https://developers.optimizely.com/rest/v2/).

## Installation

This library requires at least version 5.3 of PHP with the `curl` extension installed.

Installing with Composer:

`php composer.phar require webmarketingroi/optimizely-php`

The command above will install the latest stable version.
Or, if you prefer a bleeding-edge version, install `dev-master` with the following
command:

`php composer.phar require webmarketingroi/optimizely-php dev-master`

## Usage

First, you need to create an instance of the `OptimizelyApiClient` class. You can do that
using the following lines of code:

```php
<?php
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;
use WebMarketingROI\OptimizelyPHP\Exception;

try {

    // If you use the "OAuth 2.0 authorization code" grant, use the following array.
    $authCredentials = array(
        'client_id' => 'YOUR_CLIENT_ID',
        'client_secret' => 'YOUR_CLIENT_SECRET',
        'refresh_token' => 'YOUR_REFRESH_TOKEN',
        // Access token is optional (if not provided, will be retrieved automatically
        // with the refresh token).
        'access_token' => 'YOUR_ACCESS_TOKEN'
    );

    // Or, if you use the "OAuth 2.0 implicit grant" or "Optimizely personal 
    // token", use the following array. Please note that personal tokens are not
    // recommended to use in production environments.
    $authCredentials = array(
        'access_token' => 'YOUR_ACCESS_TOKEN'
    );

    // Instantiate the API client.
    $client = new OptimizelyApiClient($authCredentials, 'v2');

    // Do something with the client (for example, get the projects).
    $result = $client->projects()->listAll();

    // Extract projects from result.
    $projects = $result->getPayload();
        
    foreach ($projects as $project) {
        // Get project attributes.
        $name = $project->getName();
        echo "Name: $name\n";
    }

    // Finally, retrieve the access token from the client (this is only required
    // if you use "OAuth 2.0 authorization code" grant).
    $accessToken = $client->getAccessToken();
    
    // Save the access token somewhere (to a file or database) for later use.
    file_put_contents('access_token.json', json_encode($accessToken));

} catch (Exception $e) {
    // Handle error.
    $code = $e->getCode(); // Client-specific error code.
    $httpCode = $e->getHttpCode(); // HTTP status code.
    $message = $e->getMessage(); // Error message.
    $uuid = $e->getUuid(); // Error UUID.
    echo "Exception caught: $message (code=$code http_code=$httpCode uuid=$uuid)\n";
}
```

The first argument of the `OptimizelyApiClient` constructor should be your Optimizely 
API credentials in the form of an `array`, the second argument represents the API version 
(currently, only 'v2' is supported).

*Note*: For information on how to get OAuth 2.0 credentials or a personal token, 
please refer to Optimizely's documentation https://developers.optimizely.com/x/authentication/oauth/.

### Working with Projects

#### Getting List of Projects

Use the following code to retrieve all Optimizely projects:

```php
$page = 1;
for (;;)
{
    // Get the next page of projects.
    $result = $client->projects()->listAll($page, 25);

    // Retrieve projects from Result object.
    $projects = $result->getPayload();

    // Iterate through retrieved projects
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
```

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

// On return, $result->getPayload() variable will contain the data of newly created project
$result = $client->projects()->create($project);
$createdProject = $result->getPayload();
```

or, you can use this (equivalent) code:

```php
<?php
use WebMarketingROI\OptimizelyPHP\Resource\v2\Project;

$result = new Project(array(
        'name' => 'Test Project',
        'confidence_threshold' => 0.9,
        'platform' => 'web',
        'status' => 'active'
    ));

// On return, $result->getPayload() variable will contain the data of newly created project
$result = $client->projects()->create($project);
$createdProject = $result->getPayload();
```

#### Updating Existing Project

```php
<?php

// We assume that $project is of type Project and that you retrieved it earlier
$project->setName('New Project Name');

// On return, $result->getPayload() variable will contain the data of newly created project
$result = $client->projects()->update($project);
$createdProject = $result->getPayload();
```

### More Code Examples

For additional code examples, please refer to the *examples* directory.

## Running Unit Tests

This library uses PHPUnit for testing. To run unit tests, use the following command:

```
./vendor/bin/phpunit -c ./tests/phpunit.xml --coverage-html coverage
```

If you want to run integration tests against a real Optimizely account, rename 
`tests/auth_credentials.json.dist` to `tests/auth_credentials.json` and type
your credentials in that file. Then, create the `OPTIMIZELY_PHP_TEST_INTEGRATION` 
environment variable as follows

`export OPTIMIZELY_PHP_TEST_INTEGRATION=1`

and then run unit tests.
