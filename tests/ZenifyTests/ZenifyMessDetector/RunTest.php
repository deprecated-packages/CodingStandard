<?php

namespace ZenifyTests\ZenifyMessDetector;

use ZenifyTests\MessTestCase;


class RunTest extends MessTestCase
{

	public function testRun()
	{
		$output = $this->messDetectorRunner->run();
		$this->assertSame([0 => ''], $output);
	}

}
