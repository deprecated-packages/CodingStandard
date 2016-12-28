<?php

declare(strict_types = 1);

/*
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\ControlStructures;

use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Sniff;


/**
 * Rules:
 * - Yoda condition should not be used; switch expression order
 */
final class YodaConditionSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @var string
	 */
	const NAME = 'ZenifyCodingStandard.ControlStructures.YodaCondition';

	/**
	 * @var string
	 */
	const MESSAGE_ERROR = 'Yoda condition should not be used; switch expression order';

	/**
	 * @var int
	 */
	private $position;

	/**
	 * @var PHP_CodeSniffer_File
	 */
	private $file;


	/**
	 * @return int[]
	 */
	public function register() : array
	{
		return [
			T_IS_IDENTICAL,
			T_IS_NOT_IDENTICAL,
			T_IS_EQUAL,
			T_IS_NOT_EQUAL,
			T_GREATER_THAN,
			T_LESS_THAN,
			T_IS_GREATER_OR_EQUAL,
			T_IS_SMALLER_OR_EQUAL
		];
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		$this->file = $file;
		$this->position = $position;

		$previousNonEmptyToken = $this->getPreviousNonEmptyToken();

		if ($previousNonEmptyToken) {
			if ($this->isExpressionToken($previousNonEmptyToken)) {
				$file->addError(self::MESSAGE_ERROR, $position);
			}
		}
	}


	/**
	 * @return array|bool
	 */
	private function getPreviousNonEmptyToken()
	{
		$leftTokenPosition = $this->file->findPrevious(T_WHITESPACE, ($this->position - 1), NULL, TRUE);
		$tokens = $this->file->getTokens();
		if ($leftTokenPosition) {
			return $tokens[$leftTokenPosition];
		}
		return FALSE;
	}


	private function isExpressionToken(array $token) : bool
	{
		if (in_array($token['code'], [T_MINUS, T_NULL, T_FALSE, T_TRUE, T_LNUMBER, T_CONSTANT_ENCAPSED_STRING])) {
			return TRUE;
		}
		return FALSE;
	}

}
