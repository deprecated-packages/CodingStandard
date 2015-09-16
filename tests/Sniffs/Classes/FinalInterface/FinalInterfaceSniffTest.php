<?php

namespace Zenify\CodingStandard\Tests\Sniffs\Classes\ClassDeclaration;

use PHPUnit_Framework_TestCase;
use Zenify\CodingStandard\Tests\CodeSnifferRunner;


/**
 * @covers ZenifyCodingStandard\Sniffs\Classes\FinalInterfaceSniff
 */
final class FinalInterfaceSniffTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var CodeSnifferRunner
	 */
	private $codeSnifferRunner;


	protected function setUp()
	{
		$this->codeSnifferRunner = new CodeSnifferRunner('ZenifyCodingStandard.Classes.FinalInterface');
	}


	public function testDetection()
	{
		$this->assertSame(1, $this->codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(0, $this->codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
		$this->assertSame(0, $this->codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct2.php'));
		$this->assertSame(0, $this->codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct3.php'));
	}

}
