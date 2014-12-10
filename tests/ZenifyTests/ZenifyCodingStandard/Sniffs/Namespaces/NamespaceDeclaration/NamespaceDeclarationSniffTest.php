<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Namespaces\NamespaceDeclaration;

use ZenifyTests\SniffTestCase;


class NamespaceDeclarationSniffTest extends SniffTestCase
{

	public function testWrong()
	{
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'There should be 2 empty line(s) after the namespace declaration; 1 found',
			'ZenifyCodingStandard.Namespaces.NamespaceDeclaration.BlankLineAfter'
		);

		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong2.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'There should be 2 empty line(s) after the namespace declaration; 3 found',
			'ZenifyCodingStandard.Namespaces.NamespaceDeclaration.BlankLineAfter'
		);

		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/wrong3.php');
		$this->assertCount(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'There should be 1 empty line(s) from namespace to use statement; 2 found',
			'ZenifyCodingStandard.Namespaces.NamespaceDeclaration.BlankLineAfter'
		);
	}


	public function testCorrect()
	{
		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/correct.php');
		$this->assertCount(0, $result['errors']);

		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/correct2.php');
		$this->assertCount(0, $result['errors']);

		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/correct3.php');
		$this->assertCount(0, $result['errors']);

		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/correct4.php');
		$this->assertCount(0, $result['errors']);

		$result = $this->codeSnifferRunner->runPhpCsForFile(__DIR__ . '/correct5.php');
		$this->assertCount(0, $result['errors']);
	}

}
