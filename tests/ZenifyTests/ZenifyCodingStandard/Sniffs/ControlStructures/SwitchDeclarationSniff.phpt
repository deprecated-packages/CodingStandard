<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\ControlStructures;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class SwitchDeclarationSniffTest extends TestCase
{

	public function testWrong()
	{
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource(__DIR__ . '/SwitchDeclaration.wrong.php'));
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource(__DIR__ . '/SwitchDeclaration.wrong2.php'));
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource(__DIR__ . '/SwitchDeclaration.wrong3.php'));
	}


	public function testCorrect()
	{
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource(__DIR__ . '/SwitchDeclaration.correct.php'));
	}

}


run(new SwitchDeclarationSniffTest);
