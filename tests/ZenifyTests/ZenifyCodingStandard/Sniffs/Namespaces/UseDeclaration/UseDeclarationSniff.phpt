<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Namespaces\UseDeclaration;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../../bootstrap.php';


class UseDeclarationSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'There must be one USE keyword per declaration',
			'ZenifyCodingStandard.Namespaces.UseDeclaration.MultipleDeclarations'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/wrong2.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'There must be one USE keyword per declaration',
			'ZenifyCodingStandard.Namespaces.UseDeclaration.MultipleDeclarations'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/wrong3.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'There must be 2 blank line(s) after the last USE statement; 1 found.',
			'ZenifyCodingStandard.Namespaces.UseDeclaration.SpaceAfterLastUse'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/correct.php');
		Assert::count(0, $result['errors']);

		$result = $this->runPhpCsForFile(__DIR__ . '/correct2.php');
		Assert::count(0, $result['errors']);
	}

}


(new UseDeclarationSniffTest)->run();
