<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace\InBetweenMethodSpacing;

use ZenifyTests\SniffTestCase;


class InBetweenMethodSpacingSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Method should have 2 empty line(s) after itself, 3 found.',
			'ZenifyCodingStandard.WhiteSpace.InBetweenMethodSpacing'
		);

		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong2.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Method should have 2 empty line(s) after itself, 1 found.',
			'ZenifyCodingStandard.WhiteSpace.InBetweenMethodSpacing'
		);
	}


	public function testCorrect()
	{
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);
	}

}
