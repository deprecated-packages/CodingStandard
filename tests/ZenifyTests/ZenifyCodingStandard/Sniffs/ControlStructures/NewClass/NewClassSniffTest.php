<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\ControlStructures\NewClass;

use ZenifyTests\SniffTestCase;


class NewClassSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/wrong.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'New class statement should not have empty parentheses',
			'ZenifyCodingStandard.ControlStructures.NewClass'
		);
	}


	public function testCorrect()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);
	}

}
