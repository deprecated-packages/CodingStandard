<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\Classes;

use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Sniff;


/**
 * Rules:
 * - Each class/interface/trait must be standalone file, apart exception classes
 */
class OneClassPerFileApartExceptionsSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @return int[]
	 */
	public function register()
	{
		return [T_CLASS, T_INTERFACE, T_TRAIT];
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();
		$errorData = [strtolower($tokens[$position]['content'])];

		$nextClass = $file->findNext($this->register(), ($tokens[$position]['scope_closer'] + 1));
		if ($nextClass !== FALSE) {
			if ($this->isExceptionClass($file, $nextClass)) {
				return;
			}
			$error = 'Each %s must be standalone file, apart exception classes';
			$file->addError($error, $nextClass, '', $errorData);
		}
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return bool
	 */
	private function isExceptionClass($file, $classPosition)
	{
		$tokens = $file->getTokens();
		$classToken = $tokens[$classPosition];
		if ($classToken['code'] !== T_CLASS) {
			return FALSE;
		}

		if ( ! $this->isClassBeingExtended($file, $classPosition)) {
			return FALSE;
		}

		$name = $this->getParentClassName($file, $classPosition);
		if (strpos($name, 'Exception') !== FALSE) {
			return TRUE;
		}
		return FALSE;
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return bool
	 */
	private function isClassBeingExtended(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();
		$extendsPosition = $file->findNext(T_EXTENDS, $position);
		if ( ! $extendsPosition) {
			return FALSE;
		}
		if (($tokens[$extendsPosition]['line'] - $tokens[$position]['line']) > 2) {
			return FALSE;
		}
		return TRUE;
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return bool|string
	 */
	private function getParentClassName(PHP_CodeSniffer_File $file, $position)
	{
		$extendsPosition = $file->findNext(T_EXTENDS, $position);
		$classBeingExtended = $file->findNext(T_STRING, $extendsPosition);
		if ($classBeingExtended) {
			$tokens = $file->getTokens();
			return $tokens[$classBeingExtended]['content'];
		}
		return FALSE;
	}

}
