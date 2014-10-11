<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class ConcatOperatorSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/ConcatOperator.wrong.php');
		Assert::count(1, $result['errors']);

		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Concat operator (.) should be surrounded by spaces.',
			'ZenifyCodingStandard.Whitespace.ConcatOperator'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/ConcatOperator.correct.php');
		Assert::count(0, $result['errors']);
	}

}


run(new ConcatOperatorSniffTest);
