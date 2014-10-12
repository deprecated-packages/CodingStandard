<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Zenify\FlashMessageComponent;


interface ControlFactory
{

	/**
	 * @return Control
	 */
	function create();

}
