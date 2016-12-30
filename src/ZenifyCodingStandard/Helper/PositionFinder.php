<?php

declare(strict_types = 1);

/*
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Helper;

use PHP_CodeSniffer_File;


final class PositionFinder
{

	public static function findFirstPositionInCurrentLine(PHP_CodeSniffer_File $file, int $position) : int
	{
		$currentPosition = $position;

		$line = $file->getTokens()[$position]['line'];
		while ($file->getTokens()[$currentPosition]['line'] === $line) {
			$currentPosition--;
		}

		return $currentPosition;
	}


	public static function findLastPositionInCurrentLine(PHP_CodeSniffer_File $file, int $position) : int
	{
		$currentPosition = $position;

		$line = $file->getTokens()[$position]['line'];
		while ($file->getTokens()[$currentPosition]['line'] === $line) {
			$currentPosition++;
		}

		return $currentPosition;
	}

}
