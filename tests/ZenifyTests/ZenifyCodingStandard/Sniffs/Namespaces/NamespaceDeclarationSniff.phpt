<?php

/**
 * @testCase
 */

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class NamespaceDeclarationSniffTest extends TestCase
{

	public function testWrong()
	{
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource(__DIR__ . '/NamespaceDeclaration.wrong.php'));
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource(__DIR__ . '/NamespaceDeclaration.wrong2.php'));
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource(__DIR__ . '/NamespaceDeclaration.wrong3.php'));
	}


	public function testCorrect()
	{
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource(__DIR__ . '/NamespaceDeclaration.correct.php'));
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource(__DIR__ . '/NamespaceDeclaration.correct2.php'));
//		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource(__DIR__ . '/NamespaceDeclaration.correct3.php'));
	}

}


run(new NamespaceDeclarationSniffTest);
