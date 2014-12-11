<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace\ConcatOperator;

use ZenifyTests\SniffTestCase;


class ConcatOperatorSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/wrong.php');
		$this->assertCount(1, $result['errors']);

		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Concat operator (.) should be surrounded by spaces.',
			'ZenifyCodingStandard.WhiteSpace.ConcatOperator'
		);
	}


	public function testCorrect()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);
	}

}
