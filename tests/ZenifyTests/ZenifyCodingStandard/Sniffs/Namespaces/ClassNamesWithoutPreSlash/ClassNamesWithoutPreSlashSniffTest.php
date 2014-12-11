<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Namespaces\ClassNamesWithoutPreSlash;

use ZenifyTests\SniffTestCase;


class ClassNamesWithoutPreSlashSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/wrong.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Class name after new/instanceof should not start with slash.',
			'ZenifyCodingStandard.Namespaces.ClassNamesWithoutPreSlash'
		);
	}


	public function testCorrect()
	{
		$result = $this->codeSnifferRunner->runForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);
	}

}
