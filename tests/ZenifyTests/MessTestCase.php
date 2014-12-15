<?php

namespace ZenifyTests;

use PHPUnit_Framework_TestCase;


class MessTestCase extends PHPUnit_Framework_TestCase
{

	/**
	 * @var MessDetectorRunner
	 */
	protected $messDetectorRunner;


	protected function setUp()
	{
		$this->messDetectorRunner = new MessDetectorRunner(
			realpath(__DIR__ . '/../../vendor/bin/phpmd'),
			realpath(__DIR__ . '/../../src')
		);
	}

}
