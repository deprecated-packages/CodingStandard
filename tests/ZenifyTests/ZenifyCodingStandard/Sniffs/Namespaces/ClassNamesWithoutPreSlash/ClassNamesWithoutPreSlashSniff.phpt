<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Namespaces\ClassNamesWithoutPreSlash;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../../bootstrap.php';


class ClassNamesWithoutPreSlashSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Class name after new/instanceof should not start with slash.',
			'ZenifyCodingStandard.Namespaces.ClassNamesWithoutPreSlash'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/correct.php');
		Assert::count(0, $result['errors']);
	}

}


(new ClassNamesWithoutPreSlashSniffTest)->run();
