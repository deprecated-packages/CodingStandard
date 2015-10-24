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
$ vendor/bin/phpcs src --standard=vendor/zenify/coding-standard/src/ZenifyCodingStandard/ruleset.xml -p
```


## PhpStorm Integration

If you use PhpStorm, code sniffer can check your syntax as you write. [How to integrate?](docs/en/integration-to-php-storm.md)


## How to Avoid Manual Usage

### 1. Composer hooks

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

This is much faster than whole project, running manually or wait for CI.

*Pretty cool, huh?*


### 2. Global install

Or you can install phpcs and this package just once and run it from there.

#### Install PHP_CodeSniffer

```sh
wget https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar
chmod +x phpcs.phar
$ sudo mv phpcs.phar /usr/local/bin/phpcs
```

#### Install this package to libs

```sh
cd /usr/local/lib/
sudo mkdir zenify-coding-standard
cd zenify-coding-standard
sudo composer create-project zenify/coding-standard
```


#### Setup pre-commit hook, it is the same for every projects

```sh
# exit status variable, in case of multiple actions
EXIT_STATUS=0

# PHPCS
# get changed .php files, ready to be committed, all but deleted
FILES=$(git diff --name-only --cached --diff-filter=ACMRTUXB | grep .php);

# run phpcs
if [ ! -z "$FILES" ]; then
	printf "Running Code Sniffer..."
	phpcs $FILES --standard=/usr/local/lib/zenify-coding-standard/coding-standard/src/ZenifyCodingStandard/ruleset.xml -p

	if [ $? -ne 0 ]
	then
		printf "\033[0;41;37mFix coding standards before commit!\033[0m\n"
		EXIT_STATUS=1
	fi
fi

exit $EXIT_STATUS
```

That's it!
