<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Classes\OneClassPerFileApartExceptions;

use ZenifyTests\SniffTestCase;


class OneClassPerFileApartExceptionsSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/wrong.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Each class must be standalone file, apart exception classes',
			'ZenifyCodingStandard.Classes.OneClassPerFileApartExceptions'
		);

		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/wrong2.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Each class must be standalone file, apart exception classes',
			'ZenifyCodingStandard.Classes.OneClassPerFileApartExceptions'
		);
	}


	public function testCorrect()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);
	}

}
