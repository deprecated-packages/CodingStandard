<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Classes\ClassDeclaration;

use ZenifyTests\SniffTestCase;


class ClassDeclarationSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong.php');
		$this->assertCount(1, $result['errors']);

		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Opening brace for the class should be followed by 1 empty line(s); 0 found.',
			'ZenifyCodingStandard.Classes.ClassDeclaration.OpenBraceFollowedByEmptyLines'
		);

		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong2.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Closing brace for the class should be preceded by 1 empty line(s); 0 found.',
			'ZenifyCodingStandard.Classes.ClassDeclaration.CloseBracePrecededByEmptyLines'
		);

		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong3.php');
		$this->assertCount(2, $result['errors']);
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
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);
	}

}
