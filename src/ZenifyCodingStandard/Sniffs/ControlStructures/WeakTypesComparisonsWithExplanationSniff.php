<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\ControlStructures;

use PHP_CodeSniffer_Sniff;
use PHP_CodeSniffer_File;


/**
 * Rules:
 * - Strong comparison should be used instead of weak one, or commented with its purpose.
 *
 * @author Jan Dolecek <juzna.cz@gmail.com>
 * @author Tomas Votruba <tomas.vot@gmail.com>
 */
class WeakTypesComparisonsWithExplanationSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @var array
	 */
	private $weakToStrong = array(
		T_IS_EQUAL => '===',
		T_IS_NOT_EQUAL => '!=='
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

		// Read tokens until EOL
		$hasComment = FALSE;
		$currentPosition = $position;
		do {
			$content = $tokens[$currentPosition]['content'];
			if ($tokens[$currentPosition]['code'] === T_COMMENT) {
				if (strpos($content, '//') !== FALSE) {
					$hasComment = TRUE;
				}
			}
			$currentPosition++;

		} while ($tokens[$currentPosition]['content'] !== PHP_EOL);

		if ( ! $hasComment) {
			$error = '"%s" should be used instead of "%s", or commented with its purpose';
			$data = array(
				$this->getStrongTypeToWeakType($tokens[$position]['code']),
				$tokens[$position]['content']
			);
			$file->addError($error, $position, '', $data);
		}
	}


	/**
	 * @param $code
	 * @return string|bool
	 */
	private function getStrongTypeToWeakType($code)
	{
		if (isset($this->weakToStrong[$code])) {
			return $this->weakToStrong[$code];
		}
		return FALSE;
	}

}
