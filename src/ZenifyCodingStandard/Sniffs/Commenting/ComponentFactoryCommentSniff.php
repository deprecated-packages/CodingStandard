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
	 * @var int
	 */
	private $position;

	/**
	 * @var PHP_CodeSniffer_File
	 */
	private $file;


	/**
	 * @return int[]
	 */
	public function register()
	{
		return [T_FUNCTION];
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		$this->file = $file;
		$this->position = $position;

		if ( ! $this->isComponentFactoryMethod()) {
			return;
		}

		$methodComment = $this->getMethodComment();
		if ( ! $methodComment) {
			$file->addError('CreateComponent* method should have a doc comment', $position, '');
			return;
		}

		if ($this->hasCommentReturnTag($methodComment) === FALSE) {
			$error = 'CreateComponent* method should have a @return tag with type';
			$file->addError($error, $position, '');
			return;
		}
	}


	/**
	 * @return bool
	 */
	private function isComponentFactoryMethod()
	{
		$functionName = $this->file->getDeclarationName($this->position);
		return (strpos($functionName, 'createComponent') === 0);
	}


	/**
	 * @return bool
	 */
	private function hasCommentReturnTag(array $comment)
	{
		foreach ($comment as $key => $commentPart) {
			if (strpos($commentPart, '* @return') !== FALSE) {
				$commentPart = trim($commentPart);
				if (strlen($commentPart) > 10) { // min length of return tag with type
					return TRUE;
				}
			}
		}

		return FALSE;
	}


	/**
	 * @return bool|array
	 */
	private function getMethodComment()
	{
		if ($this->hasMethodComment() === FALSE) {
			return FALSE;
		}

		$comment = [];
		$currentPosition = $this->file->findPrevious(T_DOC_COMMENT, $this->position);
		$tokens = $this->file->getTokens();
		while ($tokens[$currentPosition]['code'] === T_DOC_COMMENT) {
			$comment[] = $tokens[$currentPosition]['content'];
			$currentPosition--;
		}

		return array_reverse($comment);
	}


	/**
	 * @return bool
	 */
	private function hasMethodComment()
	{
		$tokens = $this->file->getTokens();
		$docPosition = $this->file->findPrevious(T_DOC_COMMENT, $this->position);
		if ($docPosition) {
			$lineDiff = $tokens[$this->position]['line'] - $tokens[$docPosition]['line'];
			if ($lineDiff === 1) {
				return TRUE;
			}
		}

		return FALSE;
	}

}
