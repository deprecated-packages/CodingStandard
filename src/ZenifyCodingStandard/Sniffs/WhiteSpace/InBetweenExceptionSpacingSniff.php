<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\WhiteSpace;

use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Sniff;


/**
 * Rules:
 * - Class followed by exception or exceptions should have X empty line(s) between themselves.
 */
class InBetweenExceptionSpacingSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @var int
	 */
	public $blankLinesBetweenClasses = 2;


	/**
	 * @return int[]
	 */
	public function register()
	{
		return array(T_CLASS, T_INTERFACE, T_TRAIT);
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		// Fix type
		$this->blankLinesBetweenClasses = (int) $this->blankLinesBetweenClasses;

		$tokens = $file->getTokens();
		$scopeCloserPosition = $tokens[$position]['scope_closer'];

		$blankLines = $this->getBlankLinesToNextClass($file, $scopeCloserPosition);
		if ($blankLines === FALSE) {
			return;
		}

		if ($blankLines !== $this->blankLinesBetweenClasses) {
			$error = 'Classes/exceptions should have %s empty line(s) between themselves; %s found';
			$data = array($this->blankLinesBetweenClasses, $blankLines);
			$file->addError($error, $scopeCloserPosition, '', $data);
		}
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return bool|int
	 */
	private function getBlankLinesToNextClass(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();
		$nextClass = $file->findNext($this->register(), $position + 1);
		$nextClassComment = $file->findNext(array(T_DOC_COMMENT_OPEN_TAG), $position + 1);

		$nextPosition = $this->getMinIfNumbers($nextClass, $nextClassComment);
		if ($nextPosition) {
			return $tokens[$nextPosition]['line'] - $tokens[$position]['line'] - 1;
		}
		return FALSE;
	}


	/**
	 * @param int $value1
	 * @param int $value2
	 * @return int
	 */
	private function getMinIfNumbers($value1, $value2)
	{
		if ($value1 && $value2) {
			return min($value1, $value2);
		}

		return $value1 ?: $value2;
	}

}
