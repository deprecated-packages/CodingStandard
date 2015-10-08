<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\Naming;


/**
 * Rules:
 * - Bool operator should be spelled 'bool'
 */
class BoolSniff extends AbstractNamingSniffer
{

	/**
	 * @return string[]
	 */
	protected function getPossibleForms()
	{
		return ['bool', 'boolean'];
	}


	/**
	 * @return string
	 */
	protected function getAllowedForm()
	{
		return 'bool';
	}


	/**
	 * @return string
	 */
	protected function getErrorMessage()
	{
		return 'Bool operator should be spelled "%s"; "%s" found';
	}

}
