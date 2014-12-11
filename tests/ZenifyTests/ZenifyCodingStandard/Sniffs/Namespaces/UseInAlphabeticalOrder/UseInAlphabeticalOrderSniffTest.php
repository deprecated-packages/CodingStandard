<?php

namespace ZenifyTests\MikulasCodeSniffs\Sniffs\UseInAlphabeticalOrder;

use ZenifyTests\SniffTestCase;


class UseInAlphabeticalOrderSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/wrong.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Use statements should be in alphabetical order',
			'ZenifyCodingStandard.Namespaces.UseInAlphabeticalOrder'
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
