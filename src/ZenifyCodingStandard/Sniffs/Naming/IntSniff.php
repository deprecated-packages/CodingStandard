<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace ZenifyCodingStandard\Sniffs\Naming;


/**
 * Rules:
 * - Integer operator should be spelled 'int'
 */
class IntSniff extends AbstractNamingSniffer
{

	/**
	 * @return string[]
	 */
	protected function getPossibleForms()
	{
		return ['int', 'integer'];
	}


	/**
	 * @return string
	 */
	protected function getAllowedForm()
	{
		return 'int';
	}


	/**
	 * @return string
	 */
	protected function getErrorMessage()
	{
		return 'Integer operator should be spelled "%s"; "%s" found';
	}

}
