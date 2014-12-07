<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\WhiteSpace\PropertiesMethodsMutualSpacing;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../../bootstrap.php';


class PropertiesMethodsMutualSpacingSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Between properties and methods should be 2 empty line(s); 1 found.',
			'ZenifyCodingStandard.WhiteSpace.PropertiesMethodsMutualSpacing.'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/wrong2.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Between properties and methods should be 2 empty line(s); 3 found.',
			'ZenifyCodingStandard.WhiteSpace.PropertiesMethodsMutualSpacing.'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/correct.php');
		Assert::count(0, $result['errors']);

		$result = $this->runPhpCsForFile(__DIR__ . '/correct2.php');
		Assert::count(0, $result['errors']);

		$result = $this->runPhpCsForFile(__DIR__ . '/correct3.php');
		Assert::count(0, $result['errors']);
	}

}


(new PropertiesMethodsMutualSpacingSniffTest)->run();
