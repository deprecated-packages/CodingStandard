<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\Naming;

use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Sniff;


/**
 * Rules:
 * - Bool operator should be spelled 'bool'
 */
class BoolSniff implements PHP_CodeSniffer_Sniff
{

	const MESSAGE_ERROR = 'Bool operator should be spelled "%s"; "%s" found';

	/**
	 * @var string
	 */
	public $preferedName = 'bool';

	/**
	 * @var int
	 */
	private $position;

	/**
	 * @var array
	 */
	private $tokens;

	/**
	 * @var PHP_CodeSniffer_File
	 */
	private $file;


	/**
	 * @return int[]
	 */
	public function register()
	{
		return array(T_DOC_COMMENT);
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

		$commentPart = $this->tokens[$position]['content'];
		if ($this->isBoolNameCommentPart($commentPart)) {
			$commentPart = trim($commentPart);
			$content = explode(' ', $commentPart);
			$booleanName = $content[2];

			if ($booleanName !== $this->preferedName) {
				$data = array($this->preferedName, $booleanName);
				$file->addError(self::MESSAGE_ERROR, $position, '', $data);
			}
		}
	}


	/**
	 * @param string $commentPart
	 * @return bool
	 */
	private function isBoolNameCommentPart($commentPart)
	{
		$prefixes = array('@return', '@param', '@var');
		foreach ($prefixes as $prefix) {
			$seek = $prefix . ' ' . $this->preferedName;
			if (strpos($commentPart, $seek) !== FALSE) {
				return TRUE;
			}
		}
		return FALSE;
	}

}
