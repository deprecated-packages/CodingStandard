<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\ControlStructures\WeakTypeComparisonWithExplanation;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../../bootstrap.php';


class WeakTypeComparisonWithExplanationSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/WeakTypeComparisonWithExplanation.wrong.php');
		Assert::count(2, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'"===" should be used instead of "==", or commented with its purpose',
			'ZenifyCodingStandard.ControlStructures.WeakTypesComparisonsWithExplanation'
		);
		$this->validateErrorMessageAndSource(
			$result['errors'][1],
			'"!==" should be used instead of "!=", or commented with its purpose',
			'ZenifyCodingStandard.ControlStructures.WeakTypesComparisonsWithExplanation'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/WeakTypeComparisonWithExplanation.correct.php');
		Assert::count(0, $result['errors']);
	}

}


(new WeakTypeComparisonWithExplanationSniffTest)->run();
