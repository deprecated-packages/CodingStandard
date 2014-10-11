<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\Whitespace;

use PHP_CodeSniffer_File;


/**
 * Rules:
 * - Else/elseif statement should be preceded by empty line.
 */
class IfElseSniff implements \PHP_CodeSniffer_Sniff
{

	/**
	 * @return int[]
	 */
	public function register()
	{
		return array(T_ELSE, T_ELSEIF);
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();
		$prev = $this->getPreviousLinePosition($file, $position);

		if ($tokens[$prev]['code'] === T_WHITESPACE && $tokens[$prev]['line'] !== $tokens[$prev - 1]['line']) {
			return;
		}

		$error = 'Else/elseif statement should be preceded by empty line';
		$file->addError($error, $position);
	}


	/**
	 * @return int
	 */
	private function getPreviousLinePosition(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();
		$currentLine = $tokens[$position]['line'];
		do {
			$position--;
		} while ($currentLine === $tokens[$position]['line']);

		return $position;
	}

}
