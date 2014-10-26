<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\WhiteSpace;


/**
 * Rules:
 * - Not operator (!) should be surrounded by spaces.
 */
class ExclamationMarkSniff implements \PHP_CodeSniffer_Sniff
{

	/**
	 * @return int[]
	 */
	public function register()
	{
		return array(
			T_BOOLEAN_NOT
		);
	}


	/**
	 * @param \PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(\PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();
		if ($tokens[$position - 1]['code'] !== T_WHITESPACE || $tokens[$position + 1]['code'] !== T_WHITESPACE) {
			$error = 'Not operator (!) should be surrounded by spaces.';
			$file->addError($error, $position);
		}
	}

}
