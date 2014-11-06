<?php

namespace ZenifyTests\MikulasCodeSniffs\Sniffs;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class UseWithoutStartingSeparatorSniffTest extends TestCase
{

	public function testWrong()
	{
		$sniff = 'cs.Formatting.UseWithoutStartingSeparator';
		$result = $this->runPhpCsForFile(
			__DIR__ . '/UseWithoutStartingSeparator.wrong.php', self::RULESET_MIKULAS, $sniff
		);
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Usings must not start with opening ns separator',
			'cs.Formatting.UseWithoutStartingSeparator.NotAllowed'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/UseWithoutStartingSeparator.correct.php');
		Assert::count(0, $result['errors']);
	}

}


run(new UseWithoutStartingSeparatorSniffTest);
