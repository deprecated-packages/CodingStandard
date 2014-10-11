<?php

/**
 * @testCase
 */

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class ConcatOperatorSniffTest extends TestCase
{

	public function testWrong()
	{
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource('/Wrong/WhiteSpace/ConcatOperator.php'));
	}


	public function testCorrect()
	{
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource('/Correct/WhiteSpace/ConcatOperator.php'));
	}

}


run(new ConcatOperatorSniffTest);
