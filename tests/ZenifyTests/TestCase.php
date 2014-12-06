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

	const RULESET_ZENIFY = '/ZenifyCodingStandard/code-sniffer-ruleset.xml';


	/**
	 * @param string $source
	 * @return int
	 */
	protected function runPhpCsForFile($source)
	{
		if ( ! file_exists($source)) {
			throw new \Exception("File $source was not found");
		}

		$rulesetPath = SRC_DIR . self::RULESET_ZENIFY;
		if ( ! file_exists($rulesetPath)) {
			throw new \Exception("Standard file $rulesetPath was not found");
		}

		$cliCommand = PHPCS_BIN . ' ' . $source . ' -s --standard=' . $rulesetPath . ' --report=json';
		echo $cliCommand . PHP_EOL; // show failed command in case of test failure

		exec($cliCommand, $output);
		$data = json_decode(implode($output));

		if (empty($data)) {
			throw new \Exception('Cli "' . $cliCommand . '" failed');
		}

		return ['errors' => $this->getAllErrors($data)];
	}


	/**
	 * @param StdClass $error
	 * @param $expectedMessage
	 * @param $expectedSource
	 */
	protected function validateErrorMessageAndSource(StdClass $error, $expectedMessage, $expectedSource)
	{
		Assert::same($expectedMessage, $error->message);
		Assert::same($expectedSource, $error->source);
	}


	/**
	 * @return array
	 */
	private function getAllErrors(StdClass $data)
	{
		$errors = [];
		foreach ($data->files as $file) {
			foreach ($file->messages as $message) {
				$errors[] = $message;
			}
		}
		return $errors;
	}

}
