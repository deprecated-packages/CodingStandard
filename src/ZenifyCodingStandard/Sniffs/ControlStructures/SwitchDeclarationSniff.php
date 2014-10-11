<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\ControlStructures;

use PHP_CodeSniffer_File;
use Squiz_Sniffs_ControlStructures_SwitchDeclarationSniff;


class SwitchDeclarationSniff extends Squiz_Sniffs_ControlStructures_SwitchDeclarationSniff
{

	/**
	 * The number of spaces code should be indented.
	 *
	 * @var int
	 */
	public $indent = 1;


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();
		// We can't process SWITCH statements unless we know where they start and end.
		if (isset($tokens[$position]['scope_opener']) === FALSE
			|| isset($tokens[$position]['scope_closer']) === FALSE
		) {
			return;
		}
		$switch = $tokens[$position];
		$nextCase = $position;
		$caseAlignment = ($switch['column'] + $this->indent);
		$caseCount = 0;
		$foundDefault = FALSE;

		$lookFor = array(T_CASE, T_DEFAULT, T_SWITCH);
		while (($nextCase = $file->findNext($lookFor, ($nextCase + 1), $switch['scope_closer'])) !== FALSE) {
			// Skip nested SWITCH statements; they are handled on their own.
			if ($tokens[$nextCase]['code'] === T_SWITCH) {
				$nextCase = $tokens[$nextCase]['scope_closer'];
				continue;
			}
			if ($tokens[$nextCase]['code'] === T_DEFAULT) {
				$type = 'Default';
				$foundDefault = TRUE;

			} else {
				$type = 'Case';
				$caseCount++;
			}

			$this->checkIfKeywordIsLowercase($file, $nextCase, $tokens, $type);
			$this->checkIfKeywordIsIndented($file, $nextCase, $tokens, $type, $caseAlignment);

			if ($type === 'Case' && ($tokens[($nextCase + 1)]['type'] !== 'T_WHITESPACE'
				|| $tokens[($nextCase + 1)]['content'] !== ' ')
			) {
				$error = 'CASE keyword must be followed by a single space';
				$file->addError($error, $nextCase, 'SpacingAfterCase');
			}
			$opener = $tokens[$nextCase]['scope_opener'];
			if ($tokens[($opener - 1)]['type'] === 'T_WHITESPACE') {
				$error = 'There must be no space before the colon in a ' . strtoupper($type) . ' statement';
				$file->addError($error, $nextCase, 'SpaceBeforeColon' . $type);
			}
			$nextBreak = $tokens[$nextCase]['scope_closer'];

			$allowedTokens = array(T_BREAK, T_RETURN, T_CONTINUE, T_THROW, T_EXIT);
			if (in_array($tokens[$nextBreak]['code'], $allowedTokens)) {
				if ($tokens[$nextBreak]['scope_condition'] === $nextCase) {
					// Only need to check a couple of things once, even if the
					// break is shared between multiple case statements, or even
					// the default case.
					if ($tokens[$nextBreak]['column'] - 1 !== $caseAlignment) {
						$error = 'Case breaking statement must be indented ' . ($this->indent + 1) . ' tabs from SWITCH keyword';
						$file->addError($error, $nextBreak, 'BreakIndent');
					}
					$prev = $file->findPrevious(T_WHITESPACE, ($nextBreak - 1), $position, TRUE);
					if ($tokens[$prev]['line'] !== ($tokens[$nextBreak]['line'] - 1)) {
						$error = 'Blank lines are not allowed before case breaking statements';
						$file->addError($error, $nextBreak, 'SpacingBeforeBreak');
					}
					$breakLine = $tokens[$nextBreak]['line'];
					$nextLine = $tokens[$tokens[$position]['scope_closer']]['line'];
					$semicolon = $file->findNext(T_SEMICOLON, $nextBreak);
					for ($i = ($semicolon + 1); $i < $tokens[$position]['scope_closer']; $i++) {
						if ($tokens[$i]['type'] !== 'T_WHITESPACE') {
							$nextLine = $tokens[$i]['line'];
							break;
						}
					}
					if ($type !== 'Case') {
						// Ensure the BREAK statement is not followed by a blank line.
						if ($nextLine !== ($breakLine + 1)) {
							$error = 'Blank lines are not allowed after the DEFAULT case\'s breaking statement';
							$file->addError($error, $nextBreak, 'SpacingAfterDefaultBreak');
						}
					}
					$caseLine = $tokens[$nextCase]['line'];
					$nextLine = $tokens[$nextBreak]['line'];
					for ($i = ($opener + 1); $i < $nextBreak; $i++) {
						if ($tokens[$i]['type'] !== 'T_WHITESPACE') {
							$nextLine = $tokens[$i]['line'];
							break;
						}
					}
					if ($nextLine !== ($caseLine + 1)) {
						$error = 'Blank lines are not allowed after ' . strtoupper($type) . ' statements';
						$file->addError($error, $nextCase, 'SpacingAfter' . $type);
					}
				}

				if ($tokens[$nextBreak]['code'] === T_BREAK) {
					$this->checkBreak($file, $nextCase, $nextBreak, $tokens, $type);
				}

			} elseif ($type === 'Default') {
				$error = 'DEFAULT case must have a breaking statement';
				$file->addError($error, $nextCase, 'DefaultNoBreak');
			}
		}
		if ($foundDefault === FALSE) {
			$error = 'All SWITCH statements must contain a DEFAULT case';
			$file->addError($error, $position, 'MissingDefault');
		}
		if ($tokens[$switch['scope_closer']]['column'] !== $switch['column']) {
			$error = 'Closing brace of SWITCH statement must be aligned with SWITCH keyword';
			$file->addError($error, $switch['scope_closer'], 'CloseBraceAlign');
		}
		if ($caseCount === 0) {
			$error = 'SWITCH statements must contain at least one CASE statement';
			$file->addError($error, $position, 'MissingCase');
		}
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @param array $tokens
	 * @param string $type
	 */
	private function checkIfKeywordIsLowercase(PHP_CodeSniffer_File $file, $position, $tokens, $type)
	{
		if ($tokens[$position]['content'] !== strtolower($tokens[$position]['content'])) {
			$expected = strtolower($tokens[$position]['content']);
			$error = strtoupper($type) . ' keyword must be lowercase; expected "%s" but found "%s"';
			$data = array(
				$expected,
				$tokens[$position]['content'],
			);
			$file->addError($error, $position, $type . 'NotLower', $data);
		}
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @param array $tokens
	 * @param string $type
	 * @param int $caseAlignment
	 */
	private function checkIfKeywordIsIndented(PHP_CodeSniffer_File $file, $position, $tokens, $type, $caseAlignment)
	{
		if ($tokens[$position]['column'] !== $caseAlignment) {
			$error = strtoupper($type) . ' keyword must be indented ' . $this->indent . ' spaces from SWITCH keyword';
			$file->addError($error, $position, $type . 'Indent');
		}
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $nextCase
	 * @param int $nextBreak
	 * @param array $tokens
	 * @param string $type
	 */
	private function checkBreak(PHP_CodeSniffer_File $file, $nextCase, $nextBreak, $tokens, $type)
	{
		if ($type === 'Case') {
			// Ensure empty CASE statements are not allowed.
			// They must have some code content in them. A comment is not enough.
			// But count RETURN statements as valid content if they also
			// happen to close the CASE statement.
			$foundContent = FALSE;
			for ($i = ($tokens[$nextCase]['scope_opener'] + 1); $i < $nextBreak; $i++) {
				if ($tokens[$i]['code'] === T_CASE) {
					$i = $tokens[$i]['scope_opener'];
					continue;
				}
				if (isset(\PHP_CodeSniffer_Tokens::$emptyTokens[$tokens[$i]['code']]) === FALSE) {
					$foundContent = TRUE;
					break;
				}
			}
			if ($foundContent === FALSE) {
				$error = 'Empty CASE statements are not allowed';
				$file->addError($error, $nextCase, 'EmptyCase');
			}

		} else {
			// Ensure empty DEFAULT statements are not allowed.
			// They must (at least) have a comment describing why
			// the default case is being ignored.
			$foundContent = FALSE;
			for ($i = ($tokens[$nextCase]['scope_opener'] + 1); $i < $nextBreak; $i++) {
				if ($tokens[$i]['type'] !== 'T_WHITESPACE') {
					$foundContent = TRUE;
					break;
				}
			}
			if ($foundContent === FALSE) {
				$error = 'Comment required for empty DEFAULT case';
				$file->addError($error, $nextCase, 'EmptyDefault');
			}
		}
	}

}
