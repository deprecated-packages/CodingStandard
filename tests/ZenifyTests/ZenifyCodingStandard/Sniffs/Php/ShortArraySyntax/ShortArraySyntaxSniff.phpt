<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Namespaces\ShortArraySyntax;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../../bootstrap.php';


class ShortArraySyntaxSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/ShortArraySyntax.wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Short array syntax should be used, instead of traditional one',
			'ZenifyCodingStandard.Php.ShortArraySyntax'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/ShortArraySyntax.correct.php');
		Assert::count(0, $result['errors']);
	}

}


(new ShortArraySyntaxSniffTest)->run();
