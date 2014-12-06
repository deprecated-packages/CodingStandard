<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\ControlStructures\SwitchDeclaration;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../../bootstrap.php';


class SwitchDeclarationSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/SwitchDeclaration.wrong.php');
		Assert::count(4, $result['errors']);
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

		$result = $this->runPhpCsForFile(__DIR__ . '/SwitchDeclaration.wrong2.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'All SWITCH statements must contain a DEFAULT case',
			'ZenifyCodingStandard.ControlStructures.SwitchDeclaration.MissingDefault'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/SwitchDeclaration.wrong3.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Empty CASE statements are not allowed',
			'ZenifyCodingStandard.ControlStructures.SwitchDeclaration.EmptyCase'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/SwitchDeclaration.correct.php');
		Assert::count(0, $result['errors']);
	}

}


(new SwitchDeclarationSniffTest)->run();
