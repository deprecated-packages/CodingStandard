<?php

/**
 * @testCase
 */

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class PropertiesMethodsMutualSpacingSniffTest extends TestCase
{

	public function testWrong()
	{
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource('/Wrong/WhiteSpace/PropertiesMethodsMutualSpacing.php'));
		Assert::same(self::CLI_ERROR, $this->runPhpCshForSource('/Wrong/WhiteSpace/PropertiesMethodsMutualSpacing2.php'));
	}


	public function testCorrect()
	{
		Assert::same(self::CLI_SUCCESS, $this->runPhpCshForSource('/Correct/WhiteSpace/PropertiesMethodsMutualSpacing.php'));
	}

}


run(new PropertiesMethodsMutualSpacingSniffTest);
