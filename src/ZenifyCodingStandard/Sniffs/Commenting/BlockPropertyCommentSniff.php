<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\Commenting;

use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Sniff;


/**
 * Rules:
 * - Block comment should be used instead of one liner.
 */
class BlockPropertyCommentSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @return int[]
	 */
	public function register()
	{
		return [T_DOC_COMMENT];
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();
		if ($this->isPropertyOrMethodComment($file, $position) === FALSE) {
			return;
		}
		if ($this->isSingleLineDoc($tokens[$position]['content']) === FALSE) {
			return;
		}

		$error = 'Block comment should be used instead of one liner';
		$file->addError($error, $position);
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return bool
	 */
	private function isPropertyOrMethodComment(PHP_CodeSniffer_File $file, $position)
	{
		$nextPropertyOrMethodPosition = $file->findNext([T_VARIABLE, T_FUNCTION], $position + 1);
		$tokens = $file->getTokens();

		if ($nextPropertyOrMethodPosition && $tokens[$nextPropertyOrMethodPosition]['code'] !== T_FUNCTION) {
			if ($this->isVariableOrPropertyUse($file, $nextPropertyOrMethodPosition) === TRUE) {
				return FALSE;
			}

			if (($tokens[$position]['line'] + 1) === $tokens[$nextPropertyOrMethodPosition]['line']) {
				return TRUE;
			}
		}

		return FALSE;
	}


	/**
	 * @param string $content
	 * @return bool
	 */
	private function isSingleLineDoc($content)
	{
		if (strpos($content, '/**') === 0 && strpos($content, '*/') !== FALSE) {
			return TRUE;
		}
		return FALSE;
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return bool
	 */
	private function isVariableOrPropertyUse(PHP_CodeSniffer_File $file, $position)
	{
		$previous = $file->findPrevious(T_OPEN_CURLY_BRACKET, $position);
		if ($previous) {
			$previous = $file->findPrevious(T_OPEN_CURLY_BRACKET, $previous - 1);
			$tokens = $file->getTokens();
			if ($tokens[$previous]['code'] === T_OPEN_CURLY_BRACKET) { // used in method
				return TRUE;
			}
		}
		return FALSE;
	}

}
