<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\ControlStructures\YodaCondition;

use ZenifyTests\SniffTestCase;


class YodaConditionSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/wrong.php');
		$this->assertCount(5, $result['errors']);
		for ($i = 0; $i < 5; $i++) {
			$this->validateErrorMessageAndSource(
				$result['errors'][$i],
				'Yoda condition should not be used; switch expression order',
				'ZenifyCodingStandard.ControlStructures.YodaCondition'
			);
		}
	}


	public function testCorrect()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);
	}

}
