<?php

namespace Zenify\CodingStandard\Tests\Sniffs\Scope\MethodScope;

use PHPUnit_Framework_TestCase;
use Zenify\CodingStandard\Tests\CodeSnifferRunner;


/**
 * @covers ZenifyCodingStandard\Sniffs\Scope\MethodScopeSniff
 */
final class MethodScopeSniffTest extends PHPUnit_Framework_TestCase
{

	public function testDetection()
	{
		$codeSnifferRunner = new CodeSnifferRunner('ZenifyCodingStandard.Scope.MethodScope');

		$this->assertSame(1, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(1, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong2.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct2.php'));
	}

}
