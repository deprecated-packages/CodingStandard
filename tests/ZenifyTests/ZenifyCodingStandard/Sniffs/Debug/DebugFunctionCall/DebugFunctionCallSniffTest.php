<?php

namespace ZenifyTests\MikulasCodeSniffs\Sniffs\DebugFunctionCall;

use ZenifyTests\SniffTestCase;


class DebugFunctionCallSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/wrong.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'The use of function dump() is forbidden',
			'ZenifyCodingStandard.Debug.DebugFunctionCall.Found'
		);
	}


	public function testCorrect()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);
	}

}
