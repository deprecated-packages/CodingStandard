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
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource(__DIR__ . '/ExclamationMark.wrong.php'));
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource(__DIR__ . '/ExclamationMark.wrong2.php'));
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource(__DIR__ . '/ExclamationMark.wrong3.php'));
	}


	public function testCorrect()
	{
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource(__DIR__ . '/ExclamationMark.correct.php'));
	}

}


run(new ExclamationMarkSniffTest);
