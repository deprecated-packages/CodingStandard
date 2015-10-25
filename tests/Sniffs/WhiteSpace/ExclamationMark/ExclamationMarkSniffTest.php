<?php

namespace Zenify\CodingStandard\Tests\Sniffs\WhiteSpace\ExclamationMark;

use PHPUnit_Framework_TestCase;
use Zenify\CodingStandard\Tests\CodeSnifferRunner;


/**
 * @covers ZenifyCodingStandard\Sniffs\WhiteSpace\ExclamationMarkSniff
 */
final class ExclamationMarkSniffTest extends PHPUnit_Framework_TestCase
{

	public function testDetection()
	{
		$codeSnifferRunner = new CodeSnifferRunner('ZenifyCodingStandard.WhiteSpace.ExclamationMark');

		$this->assertSame(1, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(1, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong2.php'));
		$this->assertSame(1, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong3.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
	}

}
