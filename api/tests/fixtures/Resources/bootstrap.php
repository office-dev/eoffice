<?php

use Symfony\Component\Dotenv\Dotenv;

require __DIR__.'/../../../vendor/autoload.php';

$dotEnv = new Dotenv();
$dotEnv->bootEnv(__DIR__.'/../../../.env', 'dev', ['test', 'behat']);

