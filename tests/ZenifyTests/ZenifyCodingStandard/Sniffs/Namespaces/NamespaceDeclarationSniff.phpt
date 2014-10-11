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
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource('/Wrong/Namespaces/NamespaceDeclaration.php'));
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource('/Wrong/Namespaces/NamespaceDeclaration2.php'));
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource('/Wrong/Namespaces/NamespaceDeclaration3.php'));
	}


	public function testCorrect()
	{
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource('/Correct/Namespaces/NamespaceDeclaration.php'));
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource('/Correct/Namespaces/NamespaceDeclaration2.php'));
//		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource('/Correct/Namespaces/NamespaceDeclaration3.php'));
	}

}


run(new NamespaceDeclarationSniffTest);
