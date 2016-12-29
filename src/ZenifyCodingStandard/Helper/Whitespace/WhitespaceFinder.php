<?php

declare(strict_types = 1);

/*
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Helper\Whitespace;

use PHP_CodeSniffer_File;


final class WhitespaceFinder
{

	public static function findNextEmptyLinePosition(PHP_CodeSniffer_File $file, int $position) : int
	{
		$tokens = $file->getTokens();

		$currentLine = $tokens[$position]['line'];
		$nextLinePosition = $position;
		do {
			++$nextLinePosition;
			$nextLine = $tokens[$nextLinePosition]['line'];
		} while ($currentLine === $nextLine);

		return $nextLinePosition;
	}

}
