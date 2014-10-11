<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Classes;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class ControlSignatureSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/ControlSignature.wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Expected 1 space after IF keyword; 0 found',
			'ZenifyCodingStandard.ControlStructures.ControlSignature.SpaceAfterKeyword'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/ControlSignature.wrong2.php');
		Assert::count(2, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Expected 1 space after closing parenthesis; found ""',
			'ZenifyCodingStandard.ControlStructures.ControlSignature.SpaceAfterCloseParenthesis'
		);
		Assert::count(2, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][1],
			'There must be a single space between the closing parenthesis and the opening brace of a multi-line IF statement; found 0 spaces',
			'PEAR.ControlStructures.MultiLineCondition.SpaceBeforeOpenBrace'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/ControlSignature.wrong3.php');
		Assert::count(2, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Expected 1 space after closing parenthesis; found "\n"',
			'ZenifyCodingStandard.ControlStructures.ControlSignature.SpaceAfterCloseParenthesis'
		);
		$this->validateErrorMessageAndSource(
			$result['errors'][1],
			'There must be a single space between the closing parenthesis and the opening brace of a multi-line IF statement; found newline',
			'PEAR.ControlStructures.MultiLineCondition.NewlineBeforeOpenBrace'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/ControlSignature.correct.php');
		Assert::count(0, $result['errors']);
	}

}


run(new ControlSignatureSniffTest);
