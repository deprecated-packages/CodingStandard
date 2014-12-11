<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace\OperatorSpacing;

use ZenifyTests\SniffTestCase;


class OperatorSpacingSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/wrong.php');
		$this->assertCount(3, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Operator "&&" should be surrounded by spaces or on new line.',
			'ZenifyCodingStandard.WhiteSpace.OperatorSpacing'
		);
		$this->validateErrorMessageAndSource(
			$result['errors'][1],
			'Operator "||" should be surrounded by spaces or on new line.',
			'ZenifyCodingStandard.WhiteSpace.OperatorSpacing'
		);
		$this->validateErrorMessageAndSource(
			$result['errors'][2],
			'Operator "+" should be surrounded by spaces or on new line.',
			'ZenifyCodingStandard.WhiteSpace.OperatorSpacing'
		);
	}


	public function testCorrect()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);
	}

}
