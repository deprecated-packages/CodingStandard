<?php

namespace ZenifyTests\MikulasCodeSniffs\Sniffs;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class UseInAlphabeticalOrderSniffTest extends TestCase
{

	public function testWrong()
	{
		$sniff = 'cs.Formatting.UseInAlphabeticalOrder';
		$result = $this->runPhpCsForFile(
			__DIR__ . '/UseInAlphabeticalOrder.wrong.php', self::RULESET_MIKULAS, $sniff
		);
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Usings must be in alphabetical order',
			'cs.Formatting.UseInAlphabeticalOrder.UseInAlphabeticalOrder'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/UseInAlphabeticalOrder.correct.php');
		Assert::count(0, $result['errors']);
	}

}


run(new UseInAlphabeticalOrderSniffTest);
