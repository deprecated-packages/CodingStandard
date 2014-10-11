<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\Commenting;

use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Sniff;


/**
 * Rules:
 * - CreateComponent* method should have a doc comment.
 * - CreateComponent* method should have a return tag.
 * - Return tag should contain type.
 */
class ComponentFactoryCommentSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * @return int[]
	 */
	public function register()
	{
		return array(T_FUNCTION);
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @param int $commentStart
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		if ( ! $this->isComponentFactoryMethod($file, $position)) {
			return;
		}

		$tokens = $file->getTokens();
		$commentEnd = $this->getCommentEnd($file, $position);
		if ( ! $this->hasMethodComment($tokens, $commentEnd)) {
			$file->addError('CreateComponent* method should have a doc comment', $position, 'Missing');
			return;
		}

		if (isset($tokens[$commentEnd]['comment_opener'])) {
			$commentStart = $tokens[$commentEnd]['comment_opener'];
			$this->processReturnTag($file, $commentStart);
		}
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return bool
	 */
	private function isComponentFactoryMethod(PHP_CodeSniffer_File $file, $position)
	{
		$functionName = $file->getDeclarationName($position);
		return (strpos($functionName, 'createComponent') === 0);
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return bool|int
	 */
	private function getCommentEnd(PHP_CodeSniffer_File $file, $position)
	{
		return $file->findPrevious(T_WHITESPACE, ($position - 3), NULL, TRUE);
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param $position
	 */
	private function processReturnTag(PHP_CodeSniffer_File $file, $position)
	{
		$tokens = $file->getTokens();

		$return = NULL;
		foreach ($tokens[$position]['comment_tags'] as $tag) {
			if ($tokens[$tag]['content'] === '@return') {
				$return = $tag;
			}
		}

		if ($return !== NULL) {
			$content = $tokens[($return + 2)]['content'];
			if (empty($content) === TRUE || $tokens[($return + 2)]['code'] !== T_DOC_COMMENT_STRING) {
				$error = 'Return tag should contain type';
				$file->addError($error, $return, 'MissingReturnType');
			}

		} else {
			$error = 'CreateComponent* method should have a @return tag';
			$file->addError($error, $tokens[$position]['comment_closer'], 'MissingReturn');
		}
	}


	/**
	 * @param array $tokens
	 * @param int $position
	 * @return bool
	 */
	private function hasMethodComment(array $tokens, $position)
	{
		if ($tokens[$position]['code'] === T_DOC_COMMENT_CLOSE_TAG) {
			return TRUE;
		}
		if ($tokens[$position]['code'] !== T_COMMENT) {
			return TRUE;
		}
		return FALSE;
	}

}
