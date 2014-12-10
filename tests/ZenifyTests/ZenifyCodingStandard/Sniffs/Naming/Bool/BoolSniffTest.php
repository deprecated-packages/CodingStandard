<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Naming\Bool;

use ZenifyTests\SniffTestCase;


class BoolSniff extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong.php');
		$this->assertCount(5, $result['errors']);
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
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);
	}

}
