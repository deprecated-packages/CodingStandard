<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\ControlStructures\SwitchDeclaration;

use ZenifyTests\SniffTestCase;


class SwitchDeclarationSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong.php');
		$this->assertCount(4, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'CASE keyword must be indented 1 spaces from SWITCH keyword',
			'ZenifyCodingStandard.ControlStructures.SwitchDeclaration.CaseIndent'
		);
		$this->validateErrorMessageAndSource(
			$result['errors'][1],
			'Case breaking statement must be indented 2 tabs from SWITCH keyword',
			'ZenifyCodingStandard.ControlStructures.SwitchDeclaration.BreakIndent'
		);
		$this->validateErrorMessageAndSource(
			$result['errors'][2],
			'DEFAULT keyword must be indented 1 spaces from SWITCH keyword',
			'ZenifyCodingStandard.ControlStructures.SwitchDeclaration.DefaultIndent'
		);
		$this->validateErrorMessageAndSource(
			$result['errors'][3],
			'Case breaking statement must be indented 2 tabs from SWITCH keyword',
			'ZenifyCodingStandard.ControlStructures.SwitchDeclaration.BreakIndent'
		);

		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong2.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'All SWITCH statements must contain a DEFAULT case',
			'ZenifyCodingStandard.ControlStructures.SwitchDeclaration.MissingDefault'
		);

		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong3.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Empty CASE statements are not allowed',
			'ZenifyCodingStandard.ControlStructures.SwitchDeclaration.EmptyCase'
		);
	}


	public function testCorrect()
	{
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);
	}

}
