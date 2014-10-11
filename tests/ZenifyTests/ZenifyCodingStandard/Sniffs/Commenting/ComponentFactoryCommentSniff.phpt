<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Classes;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class ComponentFactoryCommentSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/ComponentFactoryComment.wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'CreateComponent* method should have a doc comment',
			'ZenifyCodingStandard.Commenting.ComponentFactoryComment.Missing'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/ComponentFactoryComment.wrong2.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Return tag should contain type',
			'ZenifyCodingStandard.Commenting.ComponentFactoryComment.MissingReturnType'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/ComponentFactoryComment.wrong3.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'CreateComponent* method should have a @return tag',
			'ZenifyCodingStandard.Commenting.ComponentFactoryComment.MissingReturn'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/ComponentFactoryComment.correct.php');
		Assert::count(0, $result['errors']);
	}

}


run(new ComponentFactoryCommentSniffTest);
