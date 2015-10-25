<?php

namespace Zenify\CodingStandard\Tests\Sniffs\Php\ShortArraySyntax;

use PHPUnit_Framework_TestCase;
use Zenify\CodingStandard\Tests\CodeSnifferRunner;


/**
 * @covers ZenifyCodingStandard\Sniffs\Php\ShortArraySyntaxSniff
 */
final class ShortArraySyntaxSniffTest extends PHPUnit_Framework_TestCase
{

	public function testDetection()
	{
		$codeSnifferRunner = new CodeSnifferRunner('ZenifyCodingStandard.Php.ShortArraySyntax');

		$this->assertSame(1, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
	}

}
