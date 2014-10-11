<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class IfElseSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/IfElse.wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Else/elseif statement should be preceded by empty line',
			'ZenifyCodingStandard.Whitespace.IfElse'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/IfElse.wrong2.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Else/elseif statement should be preceded by empty line',
			'ZenifyCodingStandard.Whitespace.IfElse'
		);
	}



	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/IfElse.correct.php');
		Assert::count(0, $result['errors']);
	}

}


run(new IfElseSniffTest);
