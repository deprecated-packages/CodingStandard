<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\ControlStructures\YodaCondition;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../../bootstrap.php';


class YodaConditionSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/YodaCondition.wrong.php');
		Assert::count(5, $result['errors']);
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
		$result = $this->runPhpCsForFile(__DIR__ . '/YodaCondition.correct.php');
		Assert::count(0, $result['errors']);
	}

}


(new YodaConditionSniffTest)->run();
