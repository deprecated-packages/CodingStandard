<?php

declare(strict_types = 1);

namespace Zenify\CodingStandard\Tests\Sniffs\WhiteSpace\IfElseTryCatchFinally;

use PHPUnit\Framework\TestCase;
use Zenify\CodingStandard\Tests\CodeSnifferRunner;


/**
 * @covers \ZenifyCodingStandard\Sniffs\WhiteSpace\IfElseTryCatchFinallySniff
 */
final class IfElseTryCatchFinallySniffTest extends TestCase
{

	public function testDetection()
	{
		$codeSnifferRunner = new CodeSnifferRunner('ZenifyCodingStandard.WhiteSpace.IfElseTryCatchFinally');

		$this->assertSame(3, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
	}

}
