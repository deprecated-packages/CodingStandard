<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\ControlStructures;

use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Sniff;
use Squiz_Sniffs_ControlStructures_ControlSignatureSniff;


/**
 * Rules:
 * - New class statement should not have empty parentheses.
 */
class NewClassSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @return int[]
	 */
	public function register()
	{
		return [T_NEW];
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

		do {
			$nextPosition++;
		} while ( ! $this->doesContentContains($tokens[$nextPosition]['content'], [';', '(', ',', ')']));

		if ($tokens[$nextPosition]['content'] === '(') {
			if ($tokens[$nextPosition + 1]['content'] === ')') {
				return TRUE;
			}
		}

		return FALSE;
	}


	/**
	 * @param string $content
	 * @param array $chars
	 * @return bool
	 */
	private function doesContentContains($content, array $chars)
	{
		foreach ($chars as $char) {
			if ($content === $char) {
				return TRUE;
			}
		}
		return FALSE;
	}

}
