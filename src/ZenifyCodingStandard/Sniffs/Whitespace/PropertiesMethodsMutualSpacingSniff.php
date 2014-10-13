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
 * - Between properties and methods should be x empty line(s).
 */
class PropertiesMethodsMutualSpacingSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @var int
	 */
	public $blankLinesBetweenPropertiesAndMethods = 2;


	/**
	 * @return int[]
	 */
	public function register()
	{
		return array(T_VARIABLE);
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		// Fix type
		$this->blankLinesBetweenPropertiesAndMethods = (int) $this->blankLinesBetweenPropertiesAndMethods;

		if ($this->isLastProperty($file, $position) === FALSE) {
			return;
		}

		if ($this->areMethodsPresent($file, $position) === FALSE) {
			return;
		}

		$tokens = $file->getTokens();
		$next = $file->findNext(array(T_DOC_COMMENT_OPEN_TAG, T_FUNCTION), $position);

		$endOfProperty = $this->getEndOfProperty($file, $position);
		$blankLines = $tokens[$next]['line'] - $tokens[$endOfProperty]['line'] - 1;
		if ($blankLines !== $this->blankLinesBetweenPropertiesAndMethods) {
			$error = 'Between properties and methods should be %s empty line(s); %s found.';
			$data = array(
				$this->blankLinesBetweenPropertiesAndMethods,
				$blankLines
			);
			$file->addError($error, $position, NULL, $data);
		}
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return bool
	 */
	private function isLastProperty(PHP_CodeSniffer_File $file, $position)
	{
		if ($this->isInsideMethod($file, $position)) {
			return FALSE;
		}

		$tokens = $file->getTokens();
		$next = $file->findNext(array(T_VARIABLE, T_FUNCTION), $position + 1);
		if ($tokens[$next]['code'] === T_VARIABLE) {
			return FALSE;
		}

		return TRUE;
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return bool
	 */
	private function isInsideMethod(PHP_CodeSniffer_File $file, $position)
	{
		$previousMethod = $file->findPrevious(T_FUNCTION, $position);
		$tokens = $file->getTokens();
		if ($tokens[$previousMethod]['code'] === T_FUNCTION) {
			return TRUE;
		}
		return FALSE;
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return bool
	 */
	private function areMethodsPresent(PHP_CodeSniffer_File $file, $position)
	{
		$next = $file->findNext(T_FUNCTION, $position + 1);
		$tokens = $file->getTokens();
		if ($tokens[$next]['code'] === T_FUNCTION) {
			return TRUE;
		}
		return FALSE;
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return int
	 */
	private function getEndOfProperty(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();

		$arrayPosition = $file->findNext(T_ARRAY, $position);
		if ($tokens[$arrayPosition]['line'] === $tokens[$position]['line']) {
			if ($tokens[$arrayPosition]['parenthesis_closer']) {
				return $tokens[$arrayPosition]['parenthesis_closer'];
			}
		}
		return $position;
	}

}
