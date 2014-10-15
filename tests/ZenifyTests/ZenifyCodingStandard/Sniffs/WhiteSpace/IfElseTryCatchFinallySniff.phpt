<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class IfElseTryCatchFinallySniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/IfElseTryCatchFinally.wrong.php');
		Assert::count(3, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Elseif statement should be preceded by 1 empty line(s); 0 found',
			'ZenifyCodingStandard.Whitespace.IfElseTryCatchFinally'
		);
		$this->validateErrorMessageAndSource(
			$result['errors'][1],
			'Catch statement should be preceded by 1 empty line(s); 0 found',
			'ZenifyCodingStandard.Whitespace.IfElseTryCatchFinally'
		);
		$this->validateErrorMessageAndSource(
			$result['errors'][2],
			'Finally statement should be preceded by 1 empty line(s); 2 found',
			'ZenifyCodingStandard.Whitespace.IfElseTryCatchFinally'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/IfElseTryCatchFinally.correct.php');
		Assert::count(0, $result['errors']);
	}

}


run(new IfElseTryCatchFinallySniffTest);
