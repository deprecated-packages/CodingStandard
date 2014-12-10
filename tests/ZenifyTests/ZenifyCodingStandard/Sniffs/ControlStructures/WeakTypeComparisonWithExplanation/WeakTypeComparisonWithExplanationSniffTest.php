<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\ControlStructures\WeakTypeComparisonWithExplanation;

use ZenifyTests\SniffTestCase;


class WeakTypeComparisonWithExplanationSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong.php');
		$this->assertCount(2, $result['errors']);
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
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);
	}

}
