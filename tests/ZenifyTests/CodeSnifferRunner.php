<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyTests;

use StdClass;


class CodeSnifferRunner
{

	/**
	 * @var string
	 */
	private $codeSnifferBin;

	/**
	 * @var string
	 */
	private $rulesetFile;


	/**
	 * @param string $codeSnifferBin
	 * @param string $srcDir
	 */
	public function __construct($codeSnifferBin, $srcDir)
	{
		$this->codeSnifferBin = $codeSnifferBin;
		$this->rulesetFile = $srcDir . '/ZenifyCodingStandard/code-sniffer-ruleset.xml';
	}


	/**
	 * @param string $source
	 * @return int
	 */
	public function runForFile($source)
	{
		if ( ! file_exists($source)) {
			throw new \Exception("File $source was not found");
		}

		$cliCommand = $this->codeSnifferBin . ' ' . $source . ' -s --standard=' . $this->rulesetFile . ' --report=json';

		exec($cliCommand, $output);
		$data = json_decode(implode($output));

		if (empty($data)) {
			throw new \Exception('Cli "' . $cliCommand . '" failed');
		}

		return ['errors' => $this->getAllErrors($data)];
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
