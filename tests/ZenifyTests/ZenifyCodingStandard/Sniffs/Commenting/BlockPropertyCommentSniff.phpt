<?php

/**
 * @testCase
 * @see ZenifyCodingStandard\Sniffs\Commenting\BlockPropertyCommentSniff
 */

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Classes;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class BlockPropertyCommentSniffTest extends TestCase
{

	public function testWrong()
	{
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource(__DIR__ . '/BlockPropertyComment.wrong.php'));
	}


	public function testCorrect()
	{
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource(__DIR__ . '/BlockPropertyComment.correct.php'));
	}

}


run(new BlockPropertyCommentSniffTest);
