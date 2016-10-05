<?php

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);

putenv("APP_ENV=test");
chdir(dirname(__DIR__));
        
include './vendor/autoload.php';
