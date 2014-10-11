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
 * - Block (multi line) comments should be used instead of one liner.
 */
class BlockPropertyCommentSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @return int[]
	 */
	public function register()
	{
		return array(T_DOC_COMMENT_OPEN_TAG);
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		$closeTagPosition = $file->findNext(T_DOC_COMMENT_CLOSE_TAG, $position + 1);
		if ($this->isPropertyOrMethodComment($file, $closeTagPosition) === FALSE) {
			return;
		}
		if ($this->isSingleLineDoc($file, $position, $closeTagPosition) === FALSE) {
			return;
		}
		$error = 'Block (multi line) comment is should be used instead of one liner';
		$file->addError($error, $position);
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return bool
	 */
	private function isPropertyOrMethodComment(PHP_CodeSniffer_File $file, $position)
	{
		$nextPropertyOrMethodPosition = $file->findNext(array(T_VARIABLE, T_FUNCTION), $position + 1);
		$tokens = $file->getTokens();

		if ($tokens[$nextPropertyOrMethodPosition]['code'] !== T_FUNCTION) {
			if ($this->isVariableOrPropertyUse($file, $nextPropertyOrMethodPosition) === TRUE) {
				return FALSE;
			}
		}

		if ($tokens[$position]['line'] + 1 === $tokens[$nextPropertyOrMethodPosition]['line']) {
			return TRUE;
		}

		return FALSE;
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $openTagPosition
	 * @param int $closeTagPosition
	 * @return bool
	 */
	private function isSingleLineDoc(PHP_CodeSniffer_File $file, $openTagPosition, $closeTagPosition)
	{
		$tokens = $file->getTokens();
		$lines = $tokens[$closeTagPosition]['line'] - $tokens[$openTagPosition]['line'];

		if ($lines < 2) {
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
		$previous = $file->findPrevious(T_OPEN_CURLY_BRACKET, $previous - 1);
		$tokens = $file->getTokens();
		if ($tokens[$previous]['code'] === T_OPEN_CURLY_BRACKET) { // used in method
			return TRUE;
		}
		return FALSE;
	}

}
