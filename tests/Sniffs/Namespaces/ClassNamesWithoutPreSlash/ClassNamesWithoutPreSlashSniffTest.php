<?php

declare(strict_types = 1);

namespace Zenify\CodingStandard\Tests\Sniffs\Namespaces\ClassNamesWithoutPreSlash;

use PHPUnit\Framework\TestCase;
use Zenify\CodingStandard\Tests\CodeSnifferRunner;


/**
 * @covers \ZenifyCodingStandard\Sniffs\Namespaces\ClassNamesWithoutPreSlashSniff
 */
final class ClassNamesWithoutPreSlashSniffTest extends TestCase
{

	public function testDetection()
	{
		$codeSnifferRunner = new CodeSnifferRunner('ZenifyCodingStandard.Namespaces.ClassNamesWithoutPreSlash');

		$this->assertSame(1, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
	}

}
