<?php

require(__DIR__ . '/../vendor/autoload.php');

assert_options(ASSERT_ACTIVE, true);
assert_options(ASSERT_BAIL, true);
assert_options(ASSERT_WARNING, true);

$loader = new Composer\Autoload\ClassLoader();
$loader->add('Random\\', __DIR__);
$loader->register();
