<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Namespaces\ShortArraySyntax;

use ZenifyTests\SniffTestCase;


class ShortArraySyntaxSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/wrong.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Short array syntax should be used, instead of traditional one',
			'ZenifyCodingStandard.Php.ShortArraySyntax'
		);
	}


	public function testCorrect()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);
	}

}
