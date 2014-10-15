<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\ControlStructures;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class WeakTypeComparisonWithExplanationSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/WeakTypeComparisonWithExplanation.wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Weak equals comparison should be commented with its purpose',
			'ZenifyCodingStandard.ControlStructures.WeakTypesComparisonsWithExplanation.Operator.T_IS_EQUAL'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/WeakTypeComparisonWithExplanation.wrong2.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Weak equals comparison should be commented with its purpose',
			'ZenifyCodingStandard.ControlStructures.WeakTypesComparisonsWithExplanation.Operator.T_IS_EQUAL'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/WeakTypeComparisonWithExplanation.correct.php');
		Assert::count(0, $result['errors']);
	}

}


run(new WeakTypeComparisonWithExplanationSniffTest);
