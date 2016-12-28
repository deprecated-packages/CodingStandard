<?php

declare(strict_types = 1);

/*
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\Commenting;

use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Sniff;
use ZenifyCodingStandard\Helper\Commenting\FunctionHelper;
use ZenifyCodingStandard\Helper\Commenting\MethodDocBlock;


/**
 * Rules:
 * - Getters should have @return tag or return type.
 */
final class MethodCommentReturnTagSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @var string
	 */
	const NAME = 'ZenifyCodingStandard.Commenting.MethodCommentReturnTag';

	/**
	 * @var string[]
	 */
	private $getterMethodPrefixes = ['get', 'is', 'has', 'will', 'should'];


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
		$methodName = $file->getDeclarationName($position);
		$isGetterMethod = $this->guessIsGetterMethod($methodName);
		if ($isGetterMethod === FALSE) {
			return;
		}

		$returnTypeHint = FunctionHelper::findReturnTypeHint($file, $position);
		if ($returnTypeHint) {
			return;
		}

		$commentString = MethodDocBlock::getMethodDocBlock($file, $position);
		if (strpos($commentString, '@return') !== FALSE) {
			return;
		}

		$file->addError('Getters should have @return tag or return type.', $position);
	}


	private function guessIsGetterMethod(string $methodName) : bool
	{
		foreach ($this->getterMethodPrefixes as $getterMethodPrefix) {
			if (strpos($methodName, $getterMethodPrefix) === 0) {
				if (strlen($methodName) === strlen($getterMethodPrefix)) {
					return TRUE;
				}

				$endPosition = strlen($getterMethodPrefix);
				$firstLetterAfterGetterPrefix = $methodName[$endPosition];

				if (ctype_upper($firstLetterAfterGetterPrefix)) {
					return TRUE;
				}
			}
		}

		return FALSE;
	}

}
