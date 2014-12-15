<?php

namespace ZenifyTests;


class MessDetectorRunner
{

	/**
	 * @var string
	 */
	private $messDetectorBin;

	/**
	 * @var string
	 */
	private $srcDir;

	/**
	 * @var string
	 */
	private $rulesetFile;


	/**
	 * @param string $messDetectorBin
	 * @param string $srcDir
	 */
	public function __construct($messDetectorBin, $srcDir)
	{
		$this->messDetectorBin = $messDetectorBin;
		$this->srcDir = $srcDir;
		$this->rulesetFile = $srcDir . '/ZenifyMessDetector/ruleset.xml';
	}


	/**
	 * @return mixed
	 */
	public function run()
	{
		$cliCommand = $this->messDetectorBin . ' ' .  $this->srcDir . ' text ' . $this->rulesetFile;
		exec($cliCommand, $output);
		return $output;
	}

}
