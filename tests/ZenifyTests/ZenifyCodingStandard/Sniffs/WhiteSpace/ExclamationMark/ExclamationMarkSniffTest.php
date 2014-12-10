<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace\ExclamationMark;

use ZenifyTests\SniffTestCase;


class ExclamationMarkSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Not operator (!) should be surrounded by spaces.',
			'ZenifyCodingStandard.WhiteSpace.ExclamationMark'
		);

		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong2.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Not operator (!) should be surrounded by spaces.',
			'ZenifyCodingStandard.WhiteSpace.ExclamationMark'
		);

		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong3.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Not operator (!) should be surrounded by spaces.',
			'ZenifyCodingStandard.WhiteSpace.ExclamationMark'
		);
	}


	public function testCorrect()
	{
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);
	}

}
