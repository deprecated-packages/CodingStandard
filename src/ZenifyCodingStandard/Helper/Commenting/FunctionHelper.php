<?php

declare(strict_types = 1);

/*
 * This file is part of Symplify
 * Copyright (c) 2016 Tomas Votruba (http://tomasvotruba.cz).
 */

namespace ZenifyCodingStandard\Helper\Commenting;

use PHP_CodeSniffer_File;


/**
 * Inspired by https://github.com/slevomat/coding-standard/blob/4f81f58625bf86bd91f7fc6f8e4d12160bf03c7c/SlevomatCodingStandard/Helpers/FunctionHelper.php
 */
final class FunctionHelper
{

	/**
	 * @return string|NULL
	 */
	public static function findReturnTypeHint(PHP_CodeSniffer_File $codeSnifferFile, int $functionPointer)
	{
		$tokens = $codeSnifferFile->getTokens();
		$isAbstract = self::isAbstract($codeSnifferFile, $functionPointer);
		$colonToken = $isAbstract
			? $codeSnifferFile->findNext(
				T_COLON, $tokens[$functionPointer]['parenthesis_closer'] + 1, NULL, FALSE, NULL, TRUE
			)
			: $codeSnifferFile->findNext(
				T_COLON, $tokens[$functionPointer]['parenthesis_closer'] + 1, $tokens[$functionPointer]['scope_opener'] - 1
			);

		if ($colonToken === FALSE) {
			return NULL;
		}
		$returnTypeHint = NULL;
		$nextToken = $colonToken;

		do {
			$nextToken = $isAbstract
				? $codeSnifferFile->findNext([T_WHITESPACE, T_COMMENT, T_SEMICOLON], $nextToken + 1, NULL, TRUE, NULL, TRUE)
				: $codeSnifferFile->findNext(
					[T_WHITESPACE, T_COMMENT], $nextToken + 1, $tokens[$functionPointer]['scope_opener'] - 1, TRUE
				);

			$isTypeHint = $nextToken !== FALSE;
			if ($isTypeHint) {
				$returnTypeHint .= $tokens[$nextToken]['content'];
			}
		} while ($isTypeHint);

		return $returnTypeHint;
	}


	public static function isAbstract(PHP_CodeSniffer_File $codeSnifferFile, int $functionPointer): bool
	{
		if ( ! isset($codeSnifferFile->getTokens()[$functionPointer]['scope_opener'])) {
			return TRUE;
		}

		if ($codeSnifferFile->getTokens()[$functionPointer]['scope_opener'] >= 39) {
			return TRUE;
		}

		return FALSE;
	}

}
