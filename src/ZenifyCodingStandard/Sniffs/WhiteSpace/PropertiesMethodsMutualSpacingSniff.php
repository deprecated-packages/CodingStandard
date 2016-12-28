<?php

declare(strict_types = 1);

/*
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\WhiteSpace;

use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Sniff;


/**
 * Rules:
 * - Between properties and methods should be x empty line(s).
 */
final class PropertiesMethodsMutualSpacingSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @var int
	 */
	public $blankLinesInBetween = 2;


	/**
	 * @return int[]
	 */
	public function register() : array
	{
		return [T_VARIABLE];
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		// Fix type
		$this->blankLinesInBetween = (int) $this->blankLinesInBetween;

		if ($this->isLastProperty($file, $position) === FALSE) {
			return;
		}

		if ($this->areMethodsPresent($file, $position) === FALSE) {
			return;
		}

		$tokens = $file->getTokens();
		$next = $file->findNext([T_DOC_COMMENT_OPEN_TAG, T_FUNCTION], $position);

		$endOfProperty = $this->getEndOfProperty($file, $position);
		$blankLines = $tokens[$next]['line'] - $tokens[$endOfProperty]['line'] - 1;
		if ($blankLines !== $this->blankLinesInBetween) {
			$error = 'Between properties and methods should be %s empty line(s); %s found.';
			$data = [
				$this->blankLinesInBetween,
				$blankLines
			];
			$file->addError($error, $position, NULL, $data);
		}
	}


	private function isLastProperty(PHP_CodeSniffer_File $file, int $position) : bool
	{
		if ($this->isInsideMethod($file, $position)) {
			return FALSE;
		}

		$tokens = $file->getTokens();
		$next = $file->findNext([T_VARIABLE, T_FUNCTION], $position + 1);
		if ($tokens[$next]['code'] === T_VARIABLE) {
			return FALSE;
		}

		return TRUE;
	}


	private function isInsideMethod(PHP_CodeSniffer_File $file, int $position) : bool
	{
		$previousMethod = $file->findPrevious(T_FUNCTION, $position);
		$tokens = $file->getTokens();
		if ($tokens[$previousMethod]['code'] === T_FUNCTION) {
			return TRUE;
		}
		return FALSE;
	}


	private function areMethodsPresent(PHP_CodeSniffer_File $file, int $position) : bool
	{
		$next = $file->findNext(T_FUNCTION, $position + 1);
		$tokens = $file->getTokens();
		if ($tokens[$next]['code'] === T_FUNCTION) {
			return TRUE;
		}
		return FALSE;
	}


	private function getEndOfProperty(PHP_CodeSniffer_File $file, int $position) : int
	{
		$tokens = $file->getTokens();

		$arrayPosition = $file->findNext(T_ARRAY, $position);
		if ($tokens[$arrayPosition]['line'] === $tokens[$position]['line']) {
			if ($tokens[$arrayPosition]['parenthesis_closer']) {
				return $tokens[$arrayPosition]['parenthesis_closer'];
			}
		}

		$openShortArrayPosition = $file->findNext(T_OPEN_SHORT_ARRAY, $position);
		if ($tokens[$openShortArrayPosition]['line'] === $tokens[$position]['line']) {
			return $tokens[$openShortArrayPosition]['bracket_closer'];
		}

		return $position;
	}

}
