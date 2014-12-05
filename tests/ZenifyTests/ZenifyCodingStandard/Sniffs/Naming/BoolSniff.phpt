<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Naming;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class BoolSniff extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/Bool.wrong.php');
		Assert::count(5, $result['errors']);
		for ($i = 0; $i < 5; $i++) {
			$this->validateErrorMessageAndSource(
				$result['errors'][$i],
				'Bool operator should be spelled "bool"; "boolean" found',
				'ZenifyCodingStandard.Naming.Bool'
			);
		}
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/Bool.correct.php');
		Assert::count(0, $result['errors']);
	}

}


(new BoolSniff)->run();
