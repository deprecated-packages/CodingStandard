<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Scope\MethodScope;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../../bootstrap.php';


class MethodScopeSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Function "run" should have scope modifier.',
			'ZenifyCodingStandard.Scope.MethodScope'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/wrong2.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Interface function "run" should not have scope modifier.',
			'ZenifyCodingStandard.Scope.MethodScope'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/correct.php');
		Assert::count(0, $result['errors']);

		$result = $this->runPhpCsForFile(__DIR__ . '/correct2.php');
		Assert::count(0, $result['errors']);
	}

}


(new MethodScopeSniffTest)->run();
