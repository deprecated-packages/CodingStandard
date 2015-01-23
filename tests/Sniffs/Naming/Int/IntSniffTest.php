<?php

namespace Zenify\CodingStandard\Tests\Sniffs\Naming\Int;

use PHPUnit_Framework_TestCase;
use Zenify\CodingStandard\Tests\CodeSnifferRunner;


class BoolSniff extends PHPUnit_Framework_TestCase
{

	/**
	 * @var CodeSnifferRunner
	 */
	private $codeSnifferRunner;


	protected function setUp()
	{
		$this->codeSnifferRunner = new CodeSnifferRunner('ZenifyCodingStandard.Naming.Int');
	}


	public function testDetection()
	{
		$this->assertSame(5, $this->codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(0, $this->codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
	}

}
