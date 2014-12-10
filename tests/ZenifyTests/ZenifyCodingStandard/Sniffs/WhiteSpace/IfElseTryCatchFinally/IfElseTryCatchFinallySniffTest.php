<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace\IfElseTryCatchFinally;

use ZenifyTests\SniffTestCase;


class IfElseTryCatchFinallySniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong.php');

		$this->assertCount(PHP_VERSION_ID >= 50500 ? 3 : 2, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Elseif statement should be preceded by 1 empty line(s); 0 found',
			'ZenifyCodingStandard.WhiteSpace.IfElseTryCatchFinally'
		);
		$this->validateErrorMessageAndSource(
			$result['errors'][1],
			'Catch statement should be preceded by 1 empty line(s); 0 found',
			'ZenifyCodingStandard.WhiteSpace.IfElseTryCatchFinally'
		);

		if (PHP_VERSION_ID >= 50500) {
			$this->validateErrorMessageAndSource(
				$result['errors'][2],
				'Finally statement should be preceded by 1 empty line(s); 2 found',
				'ZenifyCodingStandard.WhiteSpace.IfElseTryCatchFinally'
			);
		}
	}


	public function testCorrect()
	{
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);
	}

}
