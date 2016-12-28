<?php

declare(strict_types = 1);

/*
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\WhiteSpace;

use PHP_CodeSniffer_File;
use Squiz_Sniffs_WhiteSpace_FunctionSpacingSniff;


/**
 * Rules:
 * - Method should have X empty line(s) after itself.
 *
 * Exceptions:
 * - Method is the first in the class, preceded by open bracket.
 * - Method is the last in the class, followed by close bracket.
 */
final class InBetweenMethodSpacingSniff extends Squiz_Sniffs_WhiteSpace_FunctionSpacingSniff
{

	/**
	 * @var string
	 */
	const NAME = 'ZenifyCodingStandard.WhiteSpace.InBetweenMethodSpacing';

	/**
	 * @var int
	 */
	public $blankLinesBetweenMethods = 2;

	/**
	 * @var int
	 */
	private $position;

	/**
	 * @var array
	 */
	private $tokens;

	/**
	 * @var PHP_CodeSniffer_File
	 */
	private $file;


	/**
	 * @return int[]
	 */
	public function register() : array
	{
		return [T_FUNCTION];
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		// Fix type
		$this->blankLinesBetweenMethods = (int) $this->blankLinesBetweenMethods;

		$this->file = $file;
		$this->position = $position;
		$this->tokens = $file->getTokens();

		$blankLinesCountAfterFunction = $this->getBlankLineCountAfterFunction();
		if ($blankLinesCountAfterFunction !== $this->blankLinesBetweenMethods) {
			if ($this->isLastMethod()) {
				return;

			} else {
				$error = 'Method should have %s empty line(s) after itself, %s found.';
				$data = [$this->blankLinesBetweenMethods, $blankLinesCountAfterFunction];
				$this->file->addError($error, $position, '', $data);
			}
		}
	}


	private function getBlankLineCountAfterFunction() : int
	{
		$closer = $this->getScopeCloser();
		$nextLineToken = $this->getNextLineTokenByScopeCloser($closer);

		$nextContent = $this->getNextLineContent($nextLineToken);
		if ($nextContent !== FALSE) {
			$foundLines = ($this->tokens[$nextContent]['line'] - $this->tokens[$nextLineToken]['line']);

		} else {
			// We are at the end of the file.
			$foundLines = $this->blankLinesBetweenMethods;
		}

		return $foundLines;
	}


	private function isLastMethod() : bool
	{
		$closer = $this->getScopeCloser();
		$nextLineToken = $this->getNextLineTokenByScopeCloser($closer);
		if ($this->tokens[$nextLineToken + 1]['code'] === T_CLOSE_CURLY_BRACKET) {
			return TRUE;
		}
		return FALSE;
	}


	/**
	 * @return bool|int
	 */
	private function getScopeCloser()
	{
		if (isset($this->tokens[$this->position]['scope_closer']) === FALSE) {
			// Must be an interface method, so the closer is the semi-colon.
			return $this->file->findNext(T_SEMICOLON, $this->position);
		}

		return $this->tokens[$this->position]['scope_closer'];
	}


	/**
	 * @return int|NULL
	 */
	private function getNextLineTokenByScopeCloser(int $closer)
	{
		$nextLineToken = NULL;
		for ($i = $closer; $i < $this->file->numTokens; $i++) {
			if (strpos($this->tokens[$i]['content'], $this->file->eolChar) === FALSE) {
				continue;

			} else {
				$nextLineToken = ($i + 1);
				if ( ! isset($this->tokens[$nextLineToken])) {
					$nextLineToken = NULL;
				}

				break;
			}
		}
		return $nextLineToken;
	}


	/**
	 * @return bool|int
	 */
	private function getNextLineContent(int $nextLineToken)
	{
		if ($nextLineToken !== NULL) {
			return $this->file->findNext(T_WHITESPACE, ($nextLineToken + 1), NULL, TRUE);
		}
		return FALSE;
	}

}
