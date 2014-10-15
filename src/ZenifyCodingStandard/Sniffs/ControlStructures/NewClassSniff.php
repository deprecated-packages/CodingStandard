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
		$nextPosition = $position;

		// find end of class instantiation (;) or first (
		do {
			$nextPosition++;

		} while ($tokens[$nextPosition]['content'] !== ';' && $tokens[$nextPosition]['content'] !== '(');

		if ($tokens[$nextPosition]['content'] === '(') {
			if ($tokens[$nextPosition + 1]['content'] === ')') {
				return TRUE;
			}
		}

		return FALSE;
	}

}
