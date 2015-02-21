<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\Commenting;

use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Standards_AbstractVariableSniff;


/**
 * Rules:
 * - Property should have docblock comment.
 */
class VarPropertyCommentSniff extends PHP_CodeSniffer_Standards_AbstractVariableSniff
{

    /**
     * {@inheritdoc}
     */
    protected function processMemberVar(PHP_CodeSniffer_File $file, $position)
    {
        $commentToken = [T_COMMENT, T_DOC_COMMENT_CLOSE_TAG];
        $commentEnd = $file->findPrevious($commentToken, $position);
        if ($commentEnd === FALSE) {
            $file->addError('Property should have docblock comment', $position);
            return;
        }
    }


    /**
     * {@inheritdoc}
     */
    protected function processVariable(PHP_CodeSniffer_File $file, $position)
    {
    }


    /**
     * {@inheritdoc}
     */
    protected function processVariableInString(PHP_CodeSniffer_File $file, $position)
    {
    }

}
