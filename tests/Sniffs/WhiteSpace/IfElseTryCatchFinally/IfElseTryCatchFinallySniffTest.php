<?php

namespace Zenify\CodingStandard\Tests\Sniffs\WhiteSpace\IfElseTryCatchFinally;

use PHPUnit_Framework_TestCase;
use Zenify\CodingStandard\Tests\CodeSnifferRunner;


class IfElseTryCatchFinallySniffTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var CodeSnifferRunner
	 */
	private $codeSnifferRunner;


	protected function setUp()
	{
		$this->codeSnifferRunner = new CodeSnifferRunner('ZenifyCodingStandard.WhiteSpace.IfElseTryCatchFinally');
	}


	public function testDetection()
	{
		$this->assertSame(
			PHP_VERSION_ID >= 50500 ? 3 : 2, $this->codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php')
		);
		$this->assertSame(0, $this->codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
	}

}
