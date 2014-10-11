<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\ControlStructures;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class WeakTypeComparisonWithExplanationSniffTest extends TestCase
{

	public function testWrong()
	{
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource(__DIR__ . '/WeakTypeComparisonWithExplanation.wrong.php'));
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource(__DIR__ . '/WeakTypeComparisonWithExplanation.wrong2.php'));
	}


	public function testCorrect()
	{
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource(__DIR__ . '/WeakTypeComparisonWithExplanation.correct.php'));
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource(__DIR__ . '/WeakTypeComparisonWithExplanation.correct2.php'));
	}

}


run(new WeakTypeComparisonWithExplanationSniffTest);
