<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Classes\BlockPropertyComment;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../../bootstrap.php';


class BlockPropertyCommentSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Block comment should be used instead of one liner',
			'ZenifyCodingStandard.Commenting.BlockPropertyComment'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/correct.php');
		Assert::count(0, $result['errors']);

		$result = $this->runPhpCsForFile(__DIR__ . '/correct2.php');
		Assert::count(0, $result['errors']);
	}

}


(new BlockPropertyCommentSniffTest)->run();
