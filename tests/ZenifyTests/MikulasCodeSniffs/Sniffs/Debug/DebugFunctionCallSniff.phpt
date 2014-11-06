<?php

namespace ZenifyTests\MikulasCodeSniffs\Sniffs;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class DebugFunctionCallSniffTest extends TestCase
{

	public function testWrong()
	{
		$sniff = 'cs.Debug.DebugFunctionCall';
		$result = $this->runPhpCsForFile(__DIR__ . '/DebugFunctionCall.wrong.php', self::RULESET_MIKULAS, $sniff);
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'The use of function dump() is forbidden',
			'cs.Debug.DebugFunctionCall.Found'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/DebugFunctionCall.correct.php');
		Assert::count(0, $result['errors']);
	}

}


run(new DebugFunctionCallSniffTest);
