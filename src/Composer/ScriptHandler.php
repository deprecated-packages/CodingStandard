<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Zenify\CodingStandard\Composer;

use Composer\Script\Event;


class ScriptHandler
{

	public function createPreCommitHook(Event $event)
	{
		self::copyIfNotExists(getcwd() . '/.git/hooks/pre-commit', __DIR__ . '/templates/git/hooks/pre-commit');
		exec('chmod +x .git/hooks/pre-commit');
	}


	/**
	 * @param string $targetFile
	 * @param string $sourceFile
	 */
	private static function copyIfNotExists($targetFile, $sourceFile)
	{
		if ( ! file_exists($targetFile)) {
			$content = file_get_contents($sourceFile);
			@mkdir(dirname($targetFile), 0777, TRUE);
			file_put_contents($targetFile, $content);
		}
	}

}
