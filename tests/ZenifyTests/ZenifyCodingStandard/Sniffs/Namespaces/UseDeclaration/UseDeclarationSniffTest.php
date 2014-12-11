<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Namespaces\UseDeclaration;

use ZenifyTests\SniffTestCase;


class UseDeclarationSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/wrong.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'There must be one USE keyword per declaration',
			'ZenifyCodingStandard.Namespaces.UseDeclaration.MultipleDeclarations'
		);

		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/wrong2.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'There must be one USE keyword per declaration',
			'ZenifyCodingStandard.Namespaces.UseDeclaration.MultipleDeclarations'
		);

		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/wrong3.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'There must be 2 blank line(s) after the last USE statement; 1 found.',
			'ZenifyCodingStandard.Namespaces.UseDeclaration.SpaceAfterLastUse'
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
