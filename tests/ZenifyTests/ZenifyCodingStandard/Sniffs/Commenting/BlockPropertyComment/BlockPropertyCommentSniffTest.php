<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Classes\BlockPropertyComment;

use ZenifyTests\SniffTestCase;


class BlockPropertyCommentSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Block comment should be used instead of one liner',
			'ZenifyCodingStandard.Commenting.BlockPropertyComment'
		);
	}


	public function testCorrect()
	{
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);

		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/correct2.php');
		$this->assertCount(0, $result['errors']);
	}

}
