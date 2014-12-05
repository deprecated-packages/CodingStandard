<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class InBetweenMethodSpacingSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/InBetweenMethodSpacing.wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Method should have 2 empty line(s) after itself, 3 found.',
			'ZenifyCodingStandard.WhiteSpace.InBetweenMethodSpacing'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/InBetweenMethodSpacing.wrong2.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Method should have 2 empty line(s) after itself, 1 found.',
			'ZenifyCodingStandard.WhiteSpace.InBetweenMethodSpacing'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/InBetweenMethodSpacing.correct.php');
		Assert::count(0, $result['errors']);
	}

}


(new InBetweenMethodSpacingSniffTest)->run();
