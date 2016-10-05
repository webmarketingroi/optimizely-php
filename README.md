# optimizely-php

A PHP wrapper library for Optimizely REST API v2.0 (https://developers.optimizely.com/rest/v2/)

## Installation

Installing with Composer:

`php composer.phar require webmarketingroi/optimizely-php`

## Usage

First, you need to create an instance of `OptimizelyApiClient` class. You do that
with the following lines of code:

```
<?php
use WebMarketingROI\OptimizelyPHP\OptimizelyApiClient;

$apiKey = '<YOUR_API_KEY>';
$client = new OptimizelyApiClient($apiKey, 'v2');
```

The first argument of client's constructor should be your Optimizely API token, the second argument
represents the API version (currently, only 'v2' is supported).

### Working with Experiments

Use the following code to retrieve all Optimizely experiments:

```
$experiments = $client->experiments()->listAll();

foreach ($experiments as $experiment) {
    echo "Name: " . $experiment->getName() . "\n";
    echo "Description: " . $experiment->getDescription() . "\n";
}
```

To add a new experiment, use the following code:

```
<?php
use WebMarketingROI\OptimizelyPHP\Resource\v2\Experiment;

$experiment = new Experiment();
$experiment->setName('Test Experiment');
$experiment->setDescription('A simple A/B test');

$client->experiments()->add($experiment);
```

