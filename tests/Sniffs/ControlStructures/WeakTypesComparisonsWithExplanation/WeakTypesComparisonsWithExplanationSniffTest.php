<?php

declare(strict_types = 1);

namespace Zenify\CodingStandard\Tests\Sniffs\ControlStructures\WeakTypesComparisonsWithExplanation;

use PHPUnit\Framework\TestCase;
use Zenify\CodingStandard\Tests\CodeSnifferRunner;


/**
 * @covers \ZenifyCodingStandard\Sniffs\ControlStructures\WeakTypesComparisonsWithExplanationSniff
 */
final class WeakTypesComparisonsWithExplanationSniffTest extends TestCase
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
