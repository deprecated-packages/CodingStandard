<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\ControlStructures;

use PHP_CodeSniffer_File;
use Squiz_Sniffs_ControlStructures_ControlSignatureSniff;


/**
 * Rules same as for parent, plus allows comments after {
 */
class ControlSignatureSniff extends Squiz_Sniffs_ControlStructures_ControlSignatureSniff
{

	/**
	 * @return int[]
	 */
	public function register()
	{
		return array(T_TRY, T_CATCH, T_DO, T_WHILE, T_FOR, T_IF, T_FOREACH, T_ELSE, T_ELSEIF);
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		$this->checkSingleSpaceAfterKeyword($file, $position);
		$this->checkSpaceAfterClosingParenthesis($file, $position);
		$this->checkSingleNewLineAfterOpeningBrace($file, $position);

		$closer = $this->getCloser($file, $position);
		if ($closer === FALSE) {
			return;
		}
		$this->checkSingleSpaceAfterClosingBrace($file, $closer);
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	private function checkSingleSpaceAfterKeyword(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();
		$found = 1;
		if ($tokens[($position + 1)]['code'] !== T_WHITESPACE) {
			$found = 0;

		} elseif ($tokens[($position + 1)]['content'] !== ' ') {
			if (strpos($tokens[($position + 1)]['content'], $file->eolChar) !== FALSE) {
				$found = 'newline';

			} else {
				$found = strlen($tokens[($position + 1)]['content']);
			}
		}

		if ($found !== 1) {
			$error = 'Expected 1 space after %s keyword; %s found';
			$data = array(
				strtoupper($tokens[$position]['content']),
				$found,
			);

			$file->addError($error, $position, 'SpaceAfterKeyword', $data);
		}
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	private function checkSpaceAfterClosingParenthesis(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();
		if (isset($tokens[$position]['parenthesis_closer']) === TRUE
			&& isset($tokens[$position]['scope_opener']) === TRUE
		) {
			$closer = $tokens[$position]['parenthesis_closer'];
			$opener = $tokens[$position]['scope_opener'];
			$content = $file->getTokensAsString(($closer + 1), ($opener - $closer - 1));

			if ($content !== ' ') {
				$error = 'Expected 1 space after closing parenthesis; found "%s"';
				$data = array(str_replace($file->eolChar, '\n', $content));
				$file->addError($error, $closer, 'SpaceAfterCloseParenthesis', $data);
			}
		}
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	private function checkSingleNewLineAfterOpeningBrace(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();
		if (isset($tokens[$position]['scope_opener']) === TRUE) {
			$opener = $tokens[$position]['scope_opener'];
			$next = $file->findNext(T_WHITESPACE, ($opener + 1), NULL, TRUE);

			// is there a comment?
			$comment = $file->findNext(T_COMMENT, ($opener + 1), NULL, TRUE);

			// comment is next => skip to next line
			if ($next === $comment + 1) {
				$position = $comment;
				while ($tokens[$comment]['line'] === $tokens[$position]['line']) {
					$position++;
				}

				$next = $file->findNext(T_LINE, $position, NULL, TRUE);
			}

			$found = ($tokens[$next]['line'] - $tokens[$opener]['line']);

			if ($found !== 1) {
				$error = 'Expected 1 newline after opening brace; %s found';
				$data = array($found);
				$file->addError($error, $opener, 'NewlineAfterOpenBrace', $data);
			}

		} else {
			if ($tokens[$position]['code'] === T_WHILE) {
				// Zero spaces after parenthesis closer.
				$closer = $tokens[$position]['parenthesis_closer'];
				$found = 0;
				if ($tokens[($closer + 1)]['code'] === T_WHITESPACE) {
					if (strpos($tokens[($closer + 1)]['content'], $file->eolChar) !== FALSE) {
						$found = 'newline';

					} else {
						$found = strlen($tokens[($closer + 1)]['content']);
					}
				}

				if ($found !== 0) {
					$error = 'Expected 0 spaces before semicolon; %s found';
					$data = array($found);
					$file->addError($error, $closer, 'SpaceBeforeSemicolon', $data);
				}
			}
		}
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return bool|int
	 */
	private function getCloser(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();
		if ($tokens[$position]['code'] === T_TRY || $tokens[$position]['code'] === T_DO) {
			return $tokens[$position]['scope_closer'];

		} else {
			if ($tokens[$position]['code'] === T_ELSE || $tokens[$position]['code'] === T_ELSEIF) {
				return $file->findPrevious(T_CLOSE_CURLY_BRACKET, ($position - 1));
			}
		}

		return FALSE;
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $closer
	 */
	private function checkSingleSpaceAfterClosingBrace(PHP_CodeSniffer_File $file, $closer)
	{
		$tokens = $file->getTokens();
		// Single space after closing brace.
		$found = 1;
		if ($tokens[($closer + 1)]['code'] !== T_WHITESPACE) {
			$found = 0;

		} else {
			if ($tokens[($closer + 1)]['content'] !== ' ') {
				if (strpos($tokens[($closer + 1)]['content'], $file->eolChar) !== FALSE) {
					$found = 'newline';

				} else {
					$found = strlen($tokens[($closer + 1)]['content']);
				}
			}
		}

		if ($found !== 1) {
			$error = 'Expected 1 space after closing brace; %s found';
			$file->addError($error, $closer, 'SpaceAfterCloseBrace', array($found));
		}
	}

}
