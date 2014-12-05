<?php

namespace ZenifyTests\MikulasCodeSniffs\Sniffs;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class DebugFunctionCallSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/DebugFunctionCall.wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'The use of function dump() is forbidden',
			'ZenifyCodingStandard.Debug.DebugFunctionCall.Found'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/DebugFunctionCall.correct.php');
		Assert::count(0, $result['errors']);
	}

}


(new DebugFunctionCallSniffTest)->run();
