<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyTests;

use StdClass;
use Tester;
use Tester\Assert;


class TestCase extends Tester\TestCase
{

	/**
	 * @param string $source
	 * @return int
	 */
	protected function runPhpCsForFile($source)
	{
		$cliCommand = PHPCS_BIN . ' ' . $source . ' --standard=' . SRC_DIR . '/ZenifyCodingStandard/ruleset.xml --report=json';
		exec($cliCommand, $output);
		$data = json_decode(implode($output));
		$result = array(
			'errors' => $this->getAllErrors($data)
		);
		return $result;
	}


	/**
	 * @param \StdClass $message
	 * @param string $message
	 * @param string $source
	 */
	protected function validateErrorMessageAndSource(\StdClass $error, $expectedMessage, $expectedSource)
	{
		Assert::same($expectedMessage, $error->message);
		Assert::same($expectedSource, $error->source);
	}


	/**
	 * @return array
	 */
	private function getAllErrors(StdClass $data)
	{
		$errors = array();
		foreach ($data->files as $file) {
			foreach ($file->messages as $message) {
				$errors[] = $message;
			}
		}
		return $errors;
	}

}
