<?php

/**
 * @testCase
 */

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class InBetweenMethodSpacingSniffTest extends TestCase
{

	public function testWrong()
	{
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource('/Wrong/WhiteSpace/InBetweenMethodSpacing.php'));
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource('/Wrong/WhiteSpace/InBetweenMethodSpacing2.php'));
	}


	public function testCorrect()
	{
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource('/Correct/WhiteSpace/InBetweenMethodSpacing.php'));
	}

}


run(new InBetweenMethodSpacingSniffTest);
