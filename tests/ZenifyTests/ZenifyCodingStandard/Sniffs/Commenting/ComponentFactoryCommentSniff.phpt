<?php

/**
 * @testCase
 * @see ZenifyCodingStandard\Sniffs\Commenting\BlockPropertyCommentSniff
 */

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Classes;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class ComponentFactoryCommentSniffTest extends TestCase
{

	public function testWrong()
	{
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource(__DIR__ . '/ComponentFactoryComment.wrong.php'));
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource(__DIR__ . '/ComponentFactoryComment.wrong2.php'));
	}


	public function testCorrect()
	{
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource(__DIR__ . '/ComponentFactoryComment.correct.php'));
	}

}


run(new ComponentFactoryCommentSniffTest);
