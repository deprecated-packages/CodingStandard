<?php

namespace Zenify\CodingStandard\Tests\Sniffs\WhiteSpace\ConcatOperator;

use PHPUnit_Framework_TestCase;
use Zenify\CodingStandard\Tests\CodeSnifferRunner;


/**
 * @covers ZenifyCodingStandard\Sniffs\WhiteSpace\ConcatOperatorSniff
 */
final class ConcatOperatorSniffTest extends PHPUnit_Framework_TestCase
{

	public function testDetection()
	{
		$codeSnifferRunner = new CodeSnifferRunner('ZenifyCodingStandard.WhiteSpace.ConcatOperator');

		$this->assertSame(1, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
	}

}
