<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Classes\ComponentFactoryComment;

use ZenifyTests\SniffTestCase;


class ComponentFactoryCommentSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'CreateComponent* method should have a doc comment',
			'ZenifyCodingStandard.Commenting.ComponentFactoryComment'
		);

		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong2.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Return tag should contain type',
			'ZenifyCodingStandard.Commenting.ComponentFactoryComment'
		);

		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong3.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'CreateComponent* method should have a @return tag',
			'ZenifyCodingStandard.Commenting.ComponentFactoryComment'
		);
	}


	public function testCorrect()
	{
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);
	}

}
