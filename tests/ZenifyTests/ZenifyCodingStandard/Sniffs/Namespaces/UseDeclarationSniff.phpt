<?php

/**
 * @testCase
 */

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class UseDeclarationSniffTest extends TestCase
{

	public function testWrong()
	{
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource('/Wrong/Namespaces/UseDeclaration.php'));
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource('/Wrong/Namespaces/UseDeclaration2.php'));
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource('/Wrong/Namespaces/UseDeclaration3.php'));
	}


	public function testCorrect()
	{
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource('/Correct/Namespaces/UseDeclaration.php'));
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource('/Correct/Namespaces/UseDeclaration2.php'));
	}

}


run(new UseDeclarationSniffTest);
