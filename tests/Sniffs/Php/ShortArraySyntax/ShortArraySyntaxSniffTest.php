<?php

declare(strict_types = 1);

namespace Zenify\CodingStandard\Tests\Sniffs\Php\ShortArraySyntax;

use PHPUnit\Framework\TestCase;
use Zenify\CodingStandard\Tests\CodeSnifferRunner;


/**
 * @covers \ZenifyCodingStandard\Sniffs\Php\ShortArraySyntaxSniff
 */
final class ShortArraySyntaxSniffTest extends TestCase
{

	public function testDetection()
	{
		$codeSnifferRunner = new CodeSnifferRunner('ZenifyCodingStandard.Php.ShortArraySyntax');

		$this->assertSame(1, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
	}

}
