<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace\ConcatOperator;

use ZenifyTests\SniffTestCase;


class DocBlockSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/wrong.php');
		$this->assertCount(4, $result['errors']);

		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'DocBlock lines should start with space (except first one)',
			'ZenifyCodingStandard.WhiteSpace.DocBlock'
		);

		$this->validateErrorMessageAndSource(
			$result['errors'][2],
			'DocBlock lines should start with space (except first one)',
			'ZenifyCodingStandard.WhiteSpace.DocBlock'
		);
	}


	public function testCorrect()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);
	}

}
