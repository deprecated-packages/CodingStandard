# Zenify/CodingStandard

[![Build Status](https://img.shields.io/travis/Zenify/CodingStandard.svg?style=flat-square)](https://travis-ci.org/Zenify/CodingStandard)
[![Quality Score](https://img.shields.io/scrutinizer/g/Zenify/CodingStandard.svg?style=flat-square)](https://scrutinizer-ci.com/g/Zenify/CodingStandard)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/Zenify/CodingStandard.svg?style=flat-square)](https://scrutinizer-ci.com/g/Zenify/CodingStandard)
[![Downloads this Month](https://img.shields.io/packagist/dm/zenify/coding-standard.svg?style=flat-square)](https://packagist.org/packages/zenify/coding-standard)
[![Latest stable](https://img.shields.io/packagist/v/zenify/coding-standard.svg?style=flat-square)](https://packagist.org/packages/zenify/coding-standard)

Set of rules for [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) preferring tabs and based on [Nette coding standard](http://nette.org/en/coding-standard).

**Check [rules overview](docs/en/zenify-rules-overview.md) for examples.**


## Install

Install the latest version via composer:

```sh
$ composer require zenify/coding-standard --dev
```


## Usage

And run Php_CodeSniffer:

```sh
$ vendor/bin/phpcs src --standard=vendor/zenify/coding-standard/src/ZenifyCodingStandard/ruleset.xml
```


## PhpStorm Integration

If you use PhpStorm, code sniffer can check your syntax as you write. [How to integrate?](docs/en/integration-to-php-storm.md)


## How to Avoid Manual Usage

In case you don't want to use Php_CodeSniffer manually, you can add pre-commit hook via `composer.json`:

```json
"scripts": {
	"post-install-cmd": [
		"Zenify\\CodingStandard\\Composer\\ScriptHandler::createPreCommitHook"
	],
	"post-update-cmd": [
		"Zenify\\CodingStandard\\Composer\\ScriptHandler::createPreCommitHook"
	]
}
```

**Every time you try to commit, Php_CodeSniffer will run on changed `.php` files only.**

This is much faster than whole project, running manually or wait for CI.
