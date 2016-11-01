<?php

declare(strict_types = 1);

/*
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\Whitespace;

use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Sniff;


/**
 * Rules:
 * - Else/elseif/catch/finally statement should be preceded by x empty line(s)
 */
final class IfElseTryCatchFinallySniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @var int
	 */
	private $blankLinesBeforeStatement = 1;


	/**
	 * {@inheritdoc}
	 */
	public function register()
	{
		return [T_ELSE, T_ELSEIF, T_CATCH, T_FINALLY];
	}


	/**
	 * {@inheritdoc}
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		// Fix type
		$this->blankLinesBeforeStatement = (int) $this->blankLinesBeforeStatement;

		$diff = $this->getEmptyLinesCountBefore($file, $position);
		if ($diff === $this->blankLinesBeforeStatement) {
			return;
		}

		$error = '%s statement should be preceded by %s empty line(s); %s found';
		$tokens = $file->getTokens();
		$data = [
			ucfirst($tokens[$position]['content']),
			$this->blankLinesBeforeStatement,
			$diff
		];
		$file->addError($error, $position, '', $data);
	}


	private function getEmptyLinesCountBefore(PHP_CodeSniffer_File $file, int $position) : int
	{
		$tokens = $file->getTokens();
		$currentLine = $tokens[$position]['line'];
		$previousPosition = $position;
		do {
			$previousPosition--;
		} while ($currentLine === $tokens[$previousPosition]['line'] || $tokens[$previousPosition]['code'] === T_WHITESPACE);

		return $tokens[$position]['line'] - $tokens[$previousPosition]['line'] - 1;
	}

}
