<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class InBetweenExceptionSpacingSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/InBetweenExceptionSpacing.wrong.php');
		Assert::count(2, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Classes/exceptions should have 2 empty line(s) between themselves; 1 found',
			'ZenifyCodingStandard.WhiteSpace.InBetweenExceptionSpacing'
		);
		$this->validateErrorMessageAndSource(
			$result['errors'][1],
			'Classes/exceptions should have 2 empty line(s) between themselves; 3 found',
			'ZenifyCodingStandard.WhiteSpace.InBetweenExceptionSpacing'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/InBetweenExceptionSpacing.correct.php');
		Assert::count(0, $result['errors']);
	}

}


run(new InBetweenExceptionSpacingSniffTest);
