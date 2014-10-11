<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyTests;

use Tester;


class TestCase extends Tester\TestCase
{

	const CLI_SUCCESS = 0;
	const CLI_ERROR = 1;


	/**
	 * @param $source
	 * @return int
	 */
	protected function runPhpCshForSource($source)
	{
		$cliCommand = PHPCS_BIN . ' ' . $source . ' ' . ' --standard=' . SRC_DIR . '/ZenifyCodingStandard/ruleset.xml';
		passthru($cliCommand, $result);
		return $result;
	}

}
