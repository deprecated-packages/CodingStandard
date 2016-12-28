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
 * - New class statement should not have empty parentheses.
 */
final class NewClassSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @var string
	 */
	const NAME = 'ZenifyCodingStandard.ControlStructures.NewClass';

	/**
	 * @return int[]
	 */
	public function register() : array
	{
		return [T_NEW];
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		if ($this->hasEmptyParentheses($file, $position)) {
			$error = 'New class statement should not have empty parentheses';
			$file->addError($error, $position);
		}
	}


	private function hasEmptyParentheses(PHP_CodeSniffer_File $file, int $position) : bool
	{
		$tokens = $file->getTokens();
		$nextPosition = $position;

		do {
			$nextPosition++;
		} while ( ! $this->doesContentContains($tokens[$nextPosition]['content'], [';', '(', ',', ')']));

		if ($tokens[$nextPosition]['content'] === '(') {
			if ($tokens[$nextPosition + 1]['content'] === ')') {
				return TRUE;
			}
		}

		return FALSE;
	}


	private function doesContentContains(string $content, array $chars) : bool
	{
		foreach ($chars as $char) {
			if ($content === $char) {
				return TRUE;
			}
		}
		return FALSE;
	}

}
