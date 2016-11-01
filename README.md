# Coding Standard

[![Build Status](https://img.shields.io/travis/Zenify/CodingStandard.svg?style=flat-square)](https://travis-ci.org/Zenify/CodingStandard)
[![Quality Score](https://img.shields.io/scrutinizer/g/Zenify/CodingStandard.svg?style=flat-square)](https://scrutinizer-ci.com/g/Zenify/CodingStandard)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/Zenify/CodingStandard.svg?style=flat-square)](https://scrutinizer-ci.com/g/Zenify/CodingStandard)
[![Downloads](https://img.shields.io/packagist/dt/zenify/coding-standard.svg?style=flat-square)](https://packagist.org/packages/zenify/coding-standard)
[![Latest stable](https://img.shields.io/packagist/v/zenify/coding-standard.svg?style=flat-square)](https://packagist.org/packages/zenify/coding-standard)

Set of rules for [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) preferring tabs and based on [Nette coding standard](http://nette.org/en/coding-standard).

**Check [rules overview](docs/en/zenify-rules-overview.md) for examples.**


## Install

```sh
$ composer require zenify/coding-standard --dev
```

## Usage

Run with Php_CodeSniffer:

```sh
vendor/bin/phpcs src --standard=vendor/zenify/coding-standard/src/ZenifyCodingStandard/ruleset.xml -p
```

That's all!


## How to be both Lazy and Safe

### Composer hook

In case you don't want to use Php_CodeSniffer manually for every change in the code you make, you can add pre-commit hook via `composer.json`:

```json
"scripts": {
	"post-install-cmd": [
		"Zenify\\CodingStandard\\Composer\\ScriptHandler::addPhpCsToPreCommitHook"
	],
	"post-update-cmd": [
		"Zenify\\CodingStandard\\Composer\\ScriptHandler::addPhpCsToPreCommitHook"
	]
}
```

**Every time you try to commit, Php_CodeSniffer will run on changed `.php` files only.**

This is much faster than checking whole project, running manually or wait for CI.

*Pretty cool, huh?*


## Testing

```sh
composer check-cs
vendor/bin/phpunit
```


## Contributing

Rules are simple:

- new feature needs tests
- all tests must pass
- 1 feature per PR

We would be happy to merge your feature then!
