<?php

namespace Zenify\CodingStandard\Tests\Sniffs\WhiteSpace\IfElseTryCatchFinally;

use PHPUnit_Framework_TestCase;
use Zenify\CodingStandard\Tests\CodeSnifferRunner;


/**
 * @covers ZenifyCodingStandard\Sniffs\WhiteSpace\IfElseTryCatchFinallySniff
 */
final class IfElseTryCatchFinallySniffTest extends PHPUnit_Framework_TestCase
{

	public function testDetection()
	{
		$codeSnifferRunner = new CodeSnifferRunner('ZenifyCodingStandard.WhiteSpace.IfElseTryCatchFinally');

		$this->assertSame(3, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
	}

}
