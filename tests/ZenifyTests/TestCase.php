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
	 * @throws \Exception
	 * @return int
	 */
	protected function runPhpCsForFile($source)
	{
		if ( ! file_exists($source)) {
			throw new \Exception("File $source was not found");
		}

		$cliCommand = PHPCS_BIN . ' ' . $source . ' --standard=' . SRC_DIR . '/ZenifyCodingStandard/ruleset.xml --report=json';
		exec($cliCommand, $output);
		$data = json_decode(implode($output));

		if (empty($data)) {
			throw new \Exception('Cli "' . $cliCommand . '" failed');
		}

		$result = array(
			'errors' => $this->getAllErrors($data)
		);
		return $result;
	}


	/**
	 * @param StdClass $error
	 * @param $expectedMessage
	 * @param $expectedSource
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
