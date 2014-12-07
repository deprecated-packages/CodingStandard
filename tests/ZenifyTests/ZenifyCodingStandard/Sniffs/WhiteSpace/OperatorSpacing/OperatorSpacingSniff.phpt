<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace\OperatorSpacing;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../../bootstrap.php';


class OperatorSpacingSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/wrong.php');
		Assert::count(3, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Operator "&&" should be surrounded by spaces or on new line.',
			'ZenifyCodingStandard.WhiteSpace.OperatorSpacing'
		);
		$this->validateErrorMessageAndSource(
			$result['errors'][1],
			'Operator "||" should be surrounded by spaces or on new line.',
			'ZenifyCodingStandard.WhiteSpace.OperatorSpacing'
		);
		$this->validateErrorMessageAndSource(
			$result['errors'][2],
			'Operator "+" should be surrounded by spaces or on new line.',
			'ZenifyCodingStandard.WhiteSpace.OperatorSpacing'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/correct.php');
		Assert::count(0, $result['errors']);
	}

}


(new OperatorSpacingSniffTest)->run();
