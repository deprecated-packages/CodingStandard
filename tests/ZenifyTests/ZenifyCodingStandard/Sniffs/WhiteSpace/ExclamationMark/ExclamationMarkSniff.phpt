<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace\ExclamationMark;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../../bootstrap.php';


class ExclamationMarkSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Not operator (!) should be surrounded by spaces.',
			'ZenifyCodingStandard.WhiteSpace.ExclamationMark'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/wrong2.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Not operator (!) should be surrounded by spaces.',
			'ZenifyCodingStandard.WhiteSpace.ExclamationMark'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/wrong3.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Not operator (!) should be surrounded by spaces.',
			'ZenifyCodingStandard.WhiteSpace.ExclamationMark'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/correct.php');
		Assert::count(0, $result['errors']);
	}

}


(new ExclamationMarkSniffTest)->run();
