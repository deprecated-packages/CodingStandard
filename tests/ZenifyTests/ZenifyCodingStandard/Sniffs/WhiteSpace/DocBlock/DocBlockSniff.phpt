<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace\ConcatOperator;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../../bootstrap.php';


class DocBlockSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/wrong.php');
		Assert::count(2, $result['errors']);

//		$this->validateErrorMessageAndSource(
//			$result['errors'][0],
//			'Concat operator (.) should be surrounded by spaces.',
//			'ZenifyCodingStandard.WhiteSpace.ConcatOperator'
//		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/correct.php');
		Assert::count(0, $result['errors']);
	}

}


(new DocBlockSniffTest)->run();
