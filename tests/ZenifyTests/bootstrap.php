<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

if (@ ! include __DIR__ . '/../../vendor/autoload.php') {
	echo 'Install Nette Tester using `composer update --dev`';
	exit(1);
}

require_once 'TestCase.php';

// configure environment
Tester\Environment::setup();
date_default_timezone_set('Europe/Prague');

// create temporary directory
define('TEMP_DIR', createTempDir());
Tracy\Debugger::$logDirectory = TEMP_DIR;


define('PHPCS_BIN', 'php ' . realpath(__DIR__ . '/../../vendor/bin/phpcs'));
define('SRC_DIR', realpath(__DIR__ . '/../../src'));


/** @return string */
function createTempDir() {
	@mkdir(__DIR__ . '/../tmp'); // @ - directory may exists
	@mkdir($tempDir = __DIR__ . '/../tmp/' . (isset($_SERVER['argv']) ? md5(serialize($_SERVER['argv'])) : getmypid()));
	Tester\Helpers::purge($tempDir);
	return realpath($tempDir);
}


function run(Tester\TestCase $testCase) {
	$testCase->run();
}
