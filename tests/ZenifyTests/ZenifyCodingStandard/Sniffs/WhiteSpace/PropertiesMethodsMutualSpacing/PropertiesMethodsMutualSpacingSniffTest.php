<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace\PropertiesMethodsMutualSpacing;

use ZenifyTests\SniffTestCase;


class PropertiesMethodsMutualSpacingSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/wrong.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Between properties and methods should be 2 empty line(s); 1 found.',
			'ZenifyCodingStandard.WhiteSpace.PropertiesMethodsMutualSpacing.'
		);

		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/wrong2.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Between properties and methods should be 2 empty line(s); 3 found.',
			'ZenifyCodingStandard.WhiteSpace.PropertiesMethodsMutualSpacing.'
		);
	}


	public function testCorrect()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);

		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/correct2.php');
		$this->assertCount(0, $result['errors']);

		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/correct3.php');
		$this->assertCount(0, $result['errors']);
	}

}
