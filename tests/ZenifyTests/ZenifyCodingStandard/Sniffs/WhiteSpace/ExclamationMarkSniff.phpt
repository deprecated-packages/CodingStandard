<?php

/**
 * @testCase
 */

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class ExclamationMarkSniffTest extends TestCase
{

	public function testWrong()
	{
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource('/Wrong/WhiteSpace/ExclamationMark.php'));
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource('/Wrong/WhiteSpace/ExclamationMark2.php'));
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource('/Wrong/WhiteSpace/ExclamationMark3.php'));
	}


	public function testCorrect()
	{
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource('/Correct/WhiteSpace/ExclamationMark.php'));
	}

}


run(new ExclamationMarkSniffTest);
