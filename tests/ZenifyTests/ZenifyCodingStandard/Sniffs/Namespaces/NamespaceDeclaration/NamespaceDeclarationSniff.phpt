<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Namespaces\NamespaceDeclaration;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../../bootstrap.php';


class NamespaceDeclarationSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/NamespaceDeclaration.wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'There should be 2 empty line(s) after the namespace declaration; 1 found',
			'ZenifyCodingStandard.Namespaces.NamespaceDeclaration.BlankLineAfter'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/NamespaceDeclaration.wrong2.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'There should be 2 empty line(s) after the namespace declaration; 3 found',
			'ZenifyCodingStandard.Namespaces.NamespaceDeclaration.BlankLineAfter'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/NamespaceDeclaration.wrong3.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'There should be 1 empty line(s) from namespace to use statement; 2 found',
			'ZenifyCodingStandard.Namespaces.NamespaceDeclaration.BlankLineAfter'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/NamespaceDeclaration.correct.php');
		Assert::count(0, $result['errors']);

		$result = $this->runPhpCsForFile(__DIR__ . '/NamespaceDeclaration.correct2.php');
		Assert::count(0, $result['errors']);

		$result = $this->runPhpCsForFile(__DIR__ . '/NamespaceDeclaration.correct3.php');
		Assert::count(0, $result['errors']);

		$result = $this->runPhpCsForFile(__DIR__ . '/NamespaceDeclaration.correct4.php');
		Assert::count(0, $result['errors']);

		$result = $this->runPhpCsForFile(__DIR__ . '/NamespaceDeclaration.correct5.php');
		Assert::count(0, $result['errors']);
	}

}


(new NamespaceDeclarationSniffTest)->run();
