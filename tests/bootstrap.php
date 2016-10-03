<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dir = (__DIR__ . '/..');

$dotenv = new \Dotenv\Dotenv($dir);
$dotenv->load();

require_once __DIR__ . '/TestCase.php';
