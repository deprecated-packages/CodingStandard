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
		return array(T_DOC_COMMENT_OPEN_TAG);
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		$this->file = $file;
		$this->tokens = $file->getTokens();

		for (; ! $this->isCommentCloseTagOnPosition($position); $position++) {
			$token = $this->tokens[$position];
			if ($this->isBoolNameInToken($token)) {
				if ( ! $this->isCorrectFormInToken($token)) {
					$content = explode(' ', $token['content']);
					$content = $content[0];
					$data = array($this->preferedName, $content);
					$file->addError(self::MESSAGE_ERROR, $position, '', $data);
				}
			}
		}
	}


	/**
	 * @param int $position
	 * @return bool
	 */
	private function isCommentCloseTagOnPosition($position)
	{
		$positionCode = $this->tokens[$position]['code'];
		$closeTags = array(T_DOC_COMMENT_CLOSE_TAG, T_DOC_COMMENT_CLOSE_TAG);
		return in_array($positionCode, $closeTags);
	}


	/**
	 * @return bool
	 */
	private function isBoolNameInToken(array $token)
	{
		foreach (array('bool', 'boolean') as $nameForm) {
			if (strpos($token['content'], $nameForm) !== FALSE) {
				return TRUE;
			}
		}
		return FALSE;
	}


	/**
	 * @return bool
	 */
	private function isCorrectFormInToken(array $token)
	{
		$content = $this->getFirstWord($token['content']);
		if ($content === $this->preferedName) {
			return TRUE;
		}
		return FALSE;
	}


	/**
	 * @param string $content
	 * @return string
	 */
	private function getFirstWord($content)
	{
		$list = explode(' ', $content);
		return $list[0];
	}

}
