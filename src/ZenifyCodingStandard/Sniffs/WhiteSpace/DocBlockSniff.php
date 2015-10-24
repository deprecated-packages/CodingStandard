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
final class DocBlockSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @var PHP_CodeSniffer_File
	 */
	private $file;

	/**
	 * @var int
	 */
	private $position;

	/**
	 * @var array[]
	 */
	private $tokens;


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
		$this->file = $file;
		$this->position = $position;
		$this->tokens = $file->getTokens();

		if ($this->isInlineComment()) {
			return;
		}

		if ( ! $this->isIndentationCorrect($file, $position)) {
			$file->addError('DocBlock lines should start with space (except first one)', $position);
		}
	}


	/**
	 * @return bool
	 */
	private function isInlineComment()
	{
		if ($this->tokens[$this->position - 1]['code'] !== T_DOC_COMMENT_WHITESPACE) {
			return TRUE;
		}
		return FALSE;
	}


	/**
	 * @return bool
	 */
	private function isIndentationCorrect()
	{
		$tokens = $this->file->getTokens();
		if ($tokens[$this->position - 1]['content'] === ' ') {
			return TRUE;
		}
		if ((strlen($tokens[$this->position - 1]['content']) % 2) === 0) {
			return TRUE;
		}
		return FALSE;
	}

}
