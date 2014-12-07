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
 * - DocBlock lines should start with space (except first one)
 */
class DocBlockSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @return int[]
	 */
	public function register()
	{
		return [T_DOC_COMMENT_STAR, T_DOC_COMMENT_CLOSE_TAG];
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		if ( ! $this->isIndentationCorrect($file, $position)) {
			$file->addError('DocBlock lines should start with space (except first one)', $position);
		}
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return bool
	 */
	private function isIndentationCorrect(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();
		if (strlen($tokens[$position - 1]['content']) % 2 === 0) {
			return TRUE;
		}
		return FALSE;
	}

}
