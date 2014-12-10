<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\Namespaces;

use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Sniff;


/**
 * Rules:
 * - There must be x empty line(s) after the namespace declaration or y empty line(s) followed by use statement.
 */
class NamespaceDeclarationSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @var int
	 */
	public $emptyLinesAfterNamespace = 2;

	/**
	 * @var int
	 */
	private $emptyLinesBeforeUseStatement;


	/**
	 * @return integer[]
	 */
	public function register()
	{
		return [T_NAMESPACE];
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		// Fix type
		$this->emptyLinesAfterNamespace = (int) $this->emptyLinesAfterNamespace;
		$this->emptyLinesBeforeUseStatement = (int) $this->emptyLinesAfterNamespace - 1;

		$linesToNextUse = $this->getLinesToNextUse($file, $position);
		$linesToNextClass = $this->getLinesToNextClass($file, $position);

		if ($linesToNextUse) {
			if ($linesToNextUse !== $this->emptyLinesBeforeUseStatement) {
				$error = 'There should be %s empty line(s) from namespace to use statement; %s found';
				$data = [
					$this->emptyLinesBeforeUseStatement,
					$linesToNextUse
				];
				$file->addError($error, $position, 'BlankLineAfter', $data);
			}

		} elseif ($linesToNextClass) {
			if ($linesToNextClass !== $this->emptyLinesAfterNamespace) {
				$error = 'There should be %s empty line(s) after the namespace declaration; %s found';
				$data = [
					$this->emptyLinesAfterNamespace,
					$linesToNextClass
				];
				$file->addError($error, $position, 'BlankLineAfter', $data);
			}
		}
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return bool|int
	 */
	private function getLinesToNextUse(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();
		$nextUse = $file->findNext(T_USE, $position, NULL, FALSE);
		if ($tokens[$nextUse]['line'] === 1) {
			return FALSE;

		} else {
			return $tokens[$nextUse]['line'] - $tokens[$position]['line'] - 1;
		}
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return bool|int
	 */
	private function getLinesToNextClass(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();
		$nextClass = $file->findNext([T_CLASS, T_INTERFACE, T_TRAIT, T_DOC_COMMENT_OPEN_TAG], $position, NULL, FALSE);
		if ($tokens[$nextClass]['line'] === 1) {
			return FALSE;

		} else {
			return $tokens[$nextClass]['line'] - $tokens[$position]['line'] - 1;
		}

	}

}
