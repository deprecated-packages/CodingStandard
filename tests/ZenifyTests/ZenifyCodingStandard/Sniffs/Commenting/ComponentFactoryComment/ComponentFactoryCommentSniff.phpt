<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Classes\ComponentFactoryComment;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../../bootstrap.php';


class ComponentFactoryCommentSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'CreateComponent* method should have a doc comment',
			'ZenifyCodingStandard.Commenting.ComponentFactoryComment'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/wrong2.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Return tag should contain type',
			'ZenifyCodingStandard.Commenting.ComponentFactoryComment'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/wrong3.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'CreateComponent* method should have a @return tag',
			'ZenifyCodingStandard.Commenting.ComponentFactoryComment'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/correct.php');
		Assert::count(0, $result['errors']);
	}

}


(new ComponentFactoryCommentSniffTest)->run();
