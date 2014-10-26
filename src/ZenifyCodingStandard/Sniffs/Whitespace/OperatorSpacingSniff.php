<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */
namespace ZenifyCodingStandard\Sniffs\WhiteSpace;

use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Sniff;
use PHP_CodeSniffer_Tokens;


/**
 * Rules:
 *
 * - Operator should be surrounded by spaces or on new line.
 */
class OperatorSpacingSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @return int[]
	 */
	public function register()
	{
		return PHP_CodeSniffer_Tokens::$booleanOperators
			+ PHP_CodeSniffer_Tokens::$comparisonTokens
			+ PHP_CodeSniffer_Tokens::$operators
			+ PHP_CodeSniffer_Tokens::$assignmentTokens
			+ array(T_INLINE_THEN, T_INLINE_ELSE);
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();

		$isSpaceBefore = ($tokens[$position - 1]['code'] === T_WHITESPACE);
		$isSpaceAfter = ($tokens[$position + 1]['code'] === T_WHITESPACE);
		$isNewlineAfter = ($tokens[$position]['line'] !== $tokens[$position + 2]['line']);
		if (! $isSpaceBefore || ! $isSpaceAfter  || $isNewlineAfter) {
			$error = 'Operator "%s" should be surrounded by spaces or on new line.';
			$data = array(
				$tokens[$position]['content']
			);
			$file->addError($error, $position, '', $data);
		}
	}

}
