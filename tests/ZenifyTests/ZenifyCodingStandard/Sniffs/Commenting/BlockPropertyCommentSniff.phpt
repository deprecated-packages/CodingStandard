<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Classes;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class BlockPropertyCommentSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/BlockPropertyComment.wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Block comment should be used instead of one liner',
			'ZenifyCodingStandard.Commenting.BlockPropertyComment'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/BlockPropertyComment.correct.php');
		Assert::count(0, $result['errors']);

		$result = $this->runPhpCsForFile(__DIR__ . '/BlockPropertyComment.correct2.php');
		Assert::count(0, $result['errors']);
	}

}


run(new BlockPropertyCommentSniffTest);
