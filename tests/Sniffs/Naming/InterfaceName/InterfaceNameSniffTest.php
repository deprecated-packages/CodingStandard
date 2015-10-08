<?php

namespace Zenify\CodingStandard\Tests\Sniffs\Naming\InterfaceName;

use PHPUnit_Framework_TestCase;
use Zenify\CodingStandard\Tests\CodeSnifferRunner;


class InterfaceNameSniffTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var CodeSnifferRunner
	 */
	private $codeSnifferRunner;


	protected function setUp()
	{
		$this->codeSnifferRunner = new CodeSnifferRunner('ZenifyCodingStandard.Naming.InterfaceName');
	}


	public function testDetection()
	{
		$this->assertSame(0, $this->codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
		$this->assertSame(0, $this->codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct2.php'));
		$this->assertSame(1, $this->codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(1, $this->codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong2.php'));
		$this->assertSame(1, $this->codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong3.php'));
		$this->assertSame(1, $this->codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong4.php'));
		$this->assertSame(1, $this->codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong5.php'));
	}

}
