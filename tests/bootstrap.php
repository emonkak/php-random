<?php

require(__DIR__ . '/../vendor/autoload.php');

$loader = new Composer\Autoload\ClassLoader();
$loader->add('Random\\', __DIR__);
$loader->register();
