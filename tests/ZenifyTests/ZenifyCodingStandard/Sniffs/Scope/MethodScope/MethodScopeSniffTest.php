<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Scope\MethodScope;

use ZenifyTests\SniffTestCase;


class MethodScopeSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/wrong.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Function "run" should have scope modifier.',
			'ZenifyCodingStandard.Scope.MethodScope'
		);

		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/wrong2.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Interface function "run" should not have scope modifier.',
			'ZenifyCodingStandard.Scope.MethodScope'
		);
	}


	public function testCorrect()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);

		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/correct2.php');
		$this->assertCount(0, $result['errors']);
	}

}
