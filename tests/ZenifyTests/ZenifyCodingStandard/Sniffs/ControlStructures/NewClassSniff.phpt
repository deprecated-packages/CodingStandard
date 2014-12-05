<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\ControlStructures;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class NewClassSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/NewClass.wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'New class statement should not have empty parentheses',
			'ZenifyCodingStandard.ControlStructures.NewClass'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/NewClass.correct.php');
		Assert::count(0, $result['errors']);
	}

}


(new NewClassSniffTest)->run();
