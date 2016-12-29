<?php

declare(strict_types = 1);

namespace Zenify\CodingStandard\Tests;

use PHP_CodeSniffer;
use Zenify\CodingStandard\Tests\Exception\FileNotFoundException;
use Zenify\CodingStandard\Tests\Exception\StandardRulesetNotFoundException;


final class CodeSnifferRunner
{

	/**
	 * @var PHP_CodeSniffer
	 */
	private $codeSniffer;

	/**
	 * @var string[]
	 */
	private $standardRulesets = [
		'ZenifyCodingStandard' => __DIR__ . '/../src/ZenifyCodingStandard/ruleset.xml'
	];


	public function __construct(string $sniff)
	{
		$ruleset = $this->detectRulesetFromSniffName($sniff);

		$this->codeSniffer = new PHP_CodeSniffer;
		$this->codeSniffer->initStandard($ruleset, [$sniff]);
	}


	public function getErrorCountInFile(string $source) : int
	{
		$this->ensureFileExists($source);

		$file = $this->codeSniffer->processFile($source);
		return $file->getErrorCount();
	}


	public function
	getFixedContent(string $source) : string
	{
		$this->ensureFileExists($source);

		$file = $this->codeSniffer->processFile($source);
		$file->fixer->fixFile();

		return $file->fixer->getContents();
	}


	public function detectRulesetFromSniffName(string $name) : string
	{
		$standard = $this->detectStandardFromSniffName($name);

		if (isset($this->standardRulesets[$standard])) {
			return $this->standardRulesets[$standard];
		}

		throw new StandardRulesetNotFoundException(
			sprintf('Ruleset for standard "%s" not found.', $standard)
		);
	}


	private function ensureFileExists(string $source)
	{
		if ( ! file_exists($source)) {
			throw new FileNotFoundException(
				sprintf('File "%s" was not found.', $source)
			);
		}
	}


	private function detectStandardFromSniffName(string $sniff) : string
	{
		$parts = explode('.', $sniff);
		if (isset($parts[0])) {
			return $parts[0];
		}

		return '';
	}

}
