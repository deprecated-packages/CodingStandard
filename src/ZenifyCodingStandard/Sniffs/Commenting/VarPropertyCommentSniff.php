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
 * - Property should have docblock comment (except for {@inheritdoc}).
 */
final class VarPropertyCommentSniff implements PHP_CodeSniffer_Sniff
{

	/**
	 * {@inheritdoc}
	 */
	public function register()
	{
		return [T_VARIABLE];
	}


	/**
	 * {@inheritdoc}
	 */
	public function process(PHP_CodeSniffer_File $file, $position)
	{
		$commentString = $this->getPropertyComment($file, $position);

		if (strpos($commentString, '{@inheritdoc}') !== FALSE) {
			return;
		}

		if (strpos($commentString, '@var') !== FALSE) {
			return;
		}

		$file->addError('Property should have docblock comment.', $position);
	}


	/**
	 * @param PHP_CodeSniffer_File $file
	 * @param int $position
	 * @return string
	 */
	private function getPropertyComment(PHP_CodeSniffer_File $file, $position)
	{
		$commentEnd = $file->findPrevious([T_DOC_COMMENT_CLOSE_TAG], $position);
		if ($commentEnd === FALSE) {
			return '';
		}

		$tokens = $file->getTokens();
		if ($tokens[$commentEnd]['code'] !== T_DOC_COMMENT_CLOSE_TAG) {
			return '';

		} else {
			// Make sure the comment we have found belongs to us.
			$commentFor = $file->findNext(T_VARIABLE, $commentEnd + 1);
			if ($commentFor !== $position) {
				return '';
			}
		}

		$commentStart = $file->findPrevious(T_DOC_COMMENT_OPEN_TAG, $position);
		return $file->getTokensAsString($commentStart, $commentEnd - $commentStart + 1);
	}

}
