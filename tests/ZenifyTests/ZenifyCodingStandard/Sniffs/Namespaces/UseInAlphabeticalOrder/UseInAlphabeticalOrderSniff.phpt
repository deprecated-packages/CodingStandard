<?php

namespace ZenifyTests\MikulasCodeSniffs\Sniffs\UseInAlphabeticalOrder;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../../bootstrap.php';


class UseInAlphabeticalOrderSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Use statements should be in alphabetical order',
			'ZenifyCodingStandard.Namespaces.UseInAlphabeticalOrder'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/correct.php');
		Assert::count(0, $result['errors']);
	}

}


(new UseInAlphabeticalOrderSniffTest)->run();
