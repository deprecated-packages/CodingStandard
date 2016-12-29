<?php

declare(strict_types = 1);

/*
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\WhiteSpace;

use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Sniff;
use ZenifyCodingStandard\Helper\Whitespace\EmptyLinesResizer;


/**
 * Rules:
 * - Else/elseif/catch/finally statement should be preceded by x empty line(s)
 */
final class IfElseTryCatchFinallySniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @var string
	 */
	const NAME = 'ZenifyCodingStandard.WhiteSpace.IfElseTryCatchFinally';

	/**
	 * @var int
	 */
	private $requiredEmptyLineCountBeforeStatement = 1;

	/**
	 * @var PHP_CodeSniffer_File
	 */
	private $file;

	/**
	 * @var int
	 */
	private $position;

	/**
	 * @var array
	 */
	private $tokens;


	/**
	 * @return int[]
	 */
	public function register() : array
	{
		return [T_ELSE, T_ELSEIF, T_CATCH, T_FINALLY];
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

		// Fix type
		$this->requiredEmptyLineCountBeforeStatement = (int) $this->requiredEmptyLineCountBeforeStatement;

		$emptyLineCountBeforeStatement = $this->getEmptyLinesCountBefore();
		if ($emptyLineCountBeforeStatement === $this->requiredEmptyLineCountBeforeStatement) {
			return;
		}

		$error = sprintf(
			'%s statement should be preceded by %s empty line(s); %s found',
			ucfirst($this->tokens[$position]['content']),
			$this->requiredEmptyLineCountBeforeStatement,
			$emptyLineCountBeforeStatement
		);
		$fix = $file->addFixableError($error, $position);
		if ($fix) {
			EmptyLinesResizer::resizeLines(
				$file,
				$this->findFirstPositionInCurrentLine($position),
				$emptyLineCountBeforeStatement,
				$this->requiredEmptyLineCountBeforeStatement
			);
		}
	}


	private function getEmptyLinesCountBefore() : int
	{
		$currentLine = $this->tokens[$this->position]['line'];
		$previousPosition = $this->position;

		do {
			$previousPosition--;
		} while (
			$currentLine === $this->tokens[$previousPosition]['line']
			|| $this->tokens[$previousPosition]['code'] === T_WHITESPACE
		);

		return $this->tokens[$this->position]['line'] - $this->tokens[$previousPosition]['line'] - 1;
	}


	private function findFirstPositionInCurrentLine(int $position) : int
	{
		$currentPosition = $position;
		$line = $this->tokens[$position]['line'];
		while ($this->tokens[$currentPosition]['line'] === $line) {
			$currentPosition--;
		}

		return $currentPosition;
	}

}
