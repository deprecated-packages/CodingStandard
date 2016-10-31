<?php

declare(strict_types = 1);

namespace Zenify\CodingStandard\Tests\Sniffs\Naming\Int;

use PHPUnit\Framework\TestCase;
use Zenify\CodingStandard\Tests\CodeSnifferRunner;


/**
 * @covers \ZenifyCodingStandard\Sniffs\Naming\IntSniff
 */
final class IntSniffTest extends TestCase
{

	public function testDetection()
	{
		$codeSnifferRunner = new CodeSnifferRunner('ZenifyCodingStandard.Naming.Int');

		$this->assertSame(5, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
	}

}
