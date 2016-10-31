<?php

declare(strict_types = 1);

namespace Zenify\CodingStandard\Tests\Sniffs\WhiteSpace\OperatorSpacing;

use PHPUnit\Framework\TestCase;
use Zenify\CodingStandard\Tests\CodeSnifferRunner;


/**
 * @covers \ZenifyCodingStandard\Sniffs\WhiteSpace\OperatorSpacingSniff
 */
final class OperatorSpacingSniffTest extends TestCase
{

	public function testDetection()
	{
		$codeSnifferRunner = new CodeSnifferRunner('ZenifyCodingStandard.WhiteSpace.OperatorSpacing');

		$this->assertSame(2, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
	}

}
