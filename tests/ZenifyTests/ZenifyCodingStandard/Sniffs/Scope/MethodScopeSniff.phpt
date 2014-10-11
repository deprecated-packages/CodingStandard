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
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource('/Wrong/Scope/MethodScope.php'));
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource('/Wrong/Scope/MethodScope2.php'));
	}


	public function testCorrect()
	{
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource('/Correct/Scope/MethodScope.php'));
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource('/Correct/Scope/MethodScope2.php'));
	}

}


run(new MethodScopeSniffTest);
