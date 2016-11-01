<?php

declare(strict_types = 1);

namespace Zenify\CodingStandard\Tests\Sniffs\Commenting\ComponentFactoryComment;

use PHPUnit\Framework\TestCase;
use Zenify\CodingStandard\Tests\CodeSnifferRunner;


/**
 * @covers \ZenifyCodingStandard\Sniffs\Commenting\ComponentFactoryCommentSniff
 */
final class ComponentFactoryCommentSniffTest extends TestCase
{

	public function testDetection()
	{
		$codeSnifferRunner = new CodeSnifferRunner('ZenifyCodingStandard.Commenting.ComponentFactoryComment');

		$this->assertSame(1, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(1, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong2.php'));
		$this->assertSame(1, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong3.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct2.php'));
	}

}
