<?php

namespace Zenify\CodingStandard\Tests\Sniffs\Naming\AbstractClassName;

use PHPUnit_Framework_TestCase;
use Zenify\CodingStandard\Tests\CodeSnifferRunner;


class AbstractClassNameSniffTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var CodeSnifferRunner
	 */
	private $codeSnifferRunner;


	protected function setUp()
	{
		$this->codeSnifferRunner = new CodeSnifferRunner('ZenifyCodingStandard.Naming.AbstractClassName');
	}


	public function testDetection()
	{
		$this->assertSame(0, $this->codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
		$this->assertSame(0, $this->codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct2.php'));
		$this->assertSame(1, $this->codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
	}

}
