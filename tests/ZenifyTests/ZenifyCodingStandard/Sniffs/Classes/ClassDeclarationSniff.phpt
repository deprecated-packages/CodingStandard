<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Classes;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class ClassDeclarationSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/ClassDeclaration.wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Opening brace for the class should be followed by 1 empty line(s); 0 found.',
			'ZenifyCodingStandard.Classes.ClassDeclaration.OpenBraceFollowedByEmptyLines'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/ClassDeclaration.wrong2.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Closing brace for the class should be preceded by 1 empty line(s); 0 found.',
			'ZenifyCodingStandard.Classes.ClassDeclaration.CloseBracePrecededByEmptyLines'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/ClassDeclaration.wrong3.php');
		Assert::count(2, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Opening brace for the class should be followed by 1 empty line(s); 2 found.',
			'ZenifyCodingStandard.Classes.ClassDeclaration.OpenBraceFollowedByEmptyLines'
		);
		$this->validateErrorMessageAndSource(
			$result['errors'][1],
			'Closing brace for the class should be preceded by 1 empty line(s); 2 found.',
			'ZenifyCodingStandard.Classes.ClassDeclaration.CloseBracePrecededByEmptyLines'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/ClassDeclaration.correct.php');
		Assert::count(0, $result['errors']);
	}

}


run(new ClassDeclarationSniffTest);
