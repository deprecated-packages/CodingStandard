<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\WhiteSpace;

use PHP_CodeSniffer_File;


/**
 * Rules:
 * - ConcatOperator (.) should be surrounded by spaces.
 */
final class ConcatOperatorSniff implements \PHP_CodeSniffer_Sniff
{

	/**
	 * @return int[]
	 */
	public function register()
	{
		return [T_STRING_CONCAT];
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();

		if ($tokens[$position + 1]['content'] === '=') {
			return;
		}

		if ($tokens[$position - 1]['code'] !== T_WHITESPACE || $tokens[$position + 1]['code'] !== T_WHITESPACE) {
			$error = 'Concat operator (.) should be surrounded by spaces.';
			$file->addError($error, $position);
		};
	}

}
