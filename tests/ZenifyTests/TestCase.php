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

	const RULESET_ZENIFY = '/ZenifyCodingStandard/ruleset.xml';
	const RULESET_MIKULAS = '/../vendor/mikulas/code-sniffs/cs/ruleset.xml';


	/**
	 * @param string $source
	 * @param string $ruleset
	 * @param string $sniff
	 * @throws \Exception
	 * @return int
	 */
	protected function runPhpCsForFile($source, $ruleset = self::RULESET_ZENIFY, $sniff = NULL)
	{
		if ( ! file_exists($source)) {
			throw new \Exception("File $source was not found");
		}

		$rulesetPath = SRC_DIR . $ruleset;
		if ( ! file_exists($rulesetPath)) {
			throw new \Exception("Standard file $rulesetPath was not found");
		}

		$cliCommand = PHPCS_BIN . ' ' . $source . ' --standard=' . $rulesetPath . ' --report=json';
		if ($sniff) {
			$cliCommand .= ' --sniffs=' . $sniff;
		}

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
