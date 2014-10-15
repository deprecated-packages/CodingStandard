<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\ControlStructures;

use PHP_CodeSniffer_File;
use Squiz_Sniffs_ControlStructures_ControlSignatureSniff;


/**
 * Rules:
 * - New class statement should not have empty parentheses.
 */
class NewClassSniff extends Squiz_Sniffs_ControlStructures_ControlSignatureSniff
{

	/**
	 * @return int[]
	 */
	public function register()
	{
		return array(T_NEW);
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		if ($this->hasEmptyParentheses($file, $position)) {
			$error = 'New class statement should not have empty parentheses';
			$file->addError($error, $position);
		}
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return bool
	 */
	private function hasEmptyParentheses(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();

		$line = $tokens[$position]['line'];
		$nextPosition = $position;

		$prev = NULL;
		do {
			$nextPosition++;
			if ($prev === '(' && $tokens[$nextPosition]['content'] === ')') {
				return TRUE;
			}
			$prev = $tokens[$nextPosition]['content'];

		} while ($tokens[$nextPosition]['line'] === $line && $tokens[$nextPosition]['content'] !== $file->eolChar);

		return FALSE;
	}

}
