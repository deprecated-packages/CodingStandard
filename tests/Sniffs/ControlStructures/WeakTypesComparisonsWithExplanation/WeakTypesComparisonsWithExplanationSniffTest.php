<?php

namespace Zenify\CodingStandard\Tests\Sniffs\ControlStructures\WeakTypesComparisonsWithExplanation;

use PHPUnit_Framework_TestCase;
use Zenify\CodingStandard\Tests\CodeSnifferRunner;


/**
 * @covers ZenifyCodingStandard\Sniffs\ControlStructures\WeakTypesComparisonsWithExplanationSniff
 */
final class WeakTypesComparisonsWithExplanationSniffTest extends PHPUnit_Framework_TestCase
{

	public function testDetection()
	{
		$codeSnifferRunner = new CodeSnifferRunner(
				'ZenifyCodingStandard.ControlStructures.WeakTypesComparisonsWithExplanation'
		);
		$this->assertSame(2, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
	}

}
