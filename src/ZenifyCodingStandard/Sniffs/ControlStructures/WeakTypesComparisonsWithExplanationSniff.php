<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\ControlStructures;

use PHP_CodeSniffer_Sniff;
use PHP_CodeSniffer_File;


/**
 * Comparison “strong typed” operators (=== and !==) are preferred
 * before “weak typed” ones (== and !=). If weak typed comparison operator is used,
 * the intention must be documented with a comment.
 *
 * Rules:
 * - Weak equals comparison must be commented with its purpose
 *
 * @author Jan Dolecek <juzna.cz@gmail.com>
 * @author Tomas Votruba <tomas.vot@gmail.com>
 */
class WeakTypesComparisonsWithExplanationSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @var array
	 */
	public $commentMustInclude = array(
		T_IS_EQUAL => 'intentionally ==',
		T_IS_NOT_EQUAL => 'intentionally !='
	);


	/**
	 * @return int[]
	 */
	public function register()
	{
		return array(T_IS_EQUAL, T_IS_NOT_EQUAL);
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();
		$operatorCode = $tokens[$position]['code'];

		// Read tokens until EOL
		$hasComment = FALSE;
		$currentPosition = $position;
		do {
			$content = $tokens[$currentPosition]['content'];
			if ($tokens[$currentPosition]['code'] === T_COMMENT) {
				if (strpos($content, $this->commentMustInclude[$operatorCode]) !== FALSE) {
					$hasComment = TRUE;
				}
			}
			$currentPosition++;

		} while ($tokens[$currentPosition]['content'] !== PHP_EOL);

		if ( ! $hasComment) {
			$error = 'Weak equals comparison must be commented with its purpose';
			$file->addError($error, $position, 'Operator.' . token_name($operatorCode));
		}
	}

}
