<?php

/**
 * @testCase
 */

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class MethodScopeSniffTest extends TestCase
{

	public function testWrong()
	{
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource(__DIR__ . '/MethodScope.wrong.php'));
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource(__DIR__ . '/MethodScope.wrong2.php'));
	}


	public function testCorrect()
	{
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource(__DIR__ . '/MethodScope.correct.php'));
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource(__DIR__ . '/MethodScope.correct2.php'));
	}

}


run(new MethodScopeSniffTest);
