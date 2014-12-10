<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyTests;

use PHPUnit_Framework_TestCase;
use stdClass;


class SniffTestCase extends PHPUnit_Framework_TestCase
{

	/**
	 * @var CodeSnifferRunner
	 */
	protected $codeSnifferRunner;


	protected function setUp()
	{
		$this->codeSnifferRunner = new CodeSnifferRunner(
			realpath(__DIR__ . '/../../vendor/bin/phpcs'),
			realpath(__DIR__ . '/../../src')
		);
	}


	/**
	 * @param stdClass $error
	 * @param string $expectedMessage
	 * @param string $expectedSource
	 */
	protected function validateErrorMessageAndSource(stdClass $error, $expectedMessage, $expectedSource)
	{
		$this->assertSame($expectedMessage, $error->message);
		$this->assertSame($expectedSource, $error->source);
	}

}
