# Zenify/CodingStandard

[![Build Status](https://img.shields.io/travis/Zenify/CodingStandard.svg?style=flat-square)](https://travis-ci.org/Zenify/CodingStandard)
[![Quality Score](https://img.shields.io/scrutinizer/g/Zenify/CodingStandard.svg?style=flat-square)](https://scrutinizer-ci.com/g/Zenify/CodingStandard)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/Zenify/CodingStandard.svg?style=flat-square)](https://scrutinizer-ci.com/g/Zenify/CodingStandard)
[![Downloads this Month](https://img.shields.io/packagist/dm/zenify/coding-standard.svg?style=flat-square)](https://packagist.org/packages/zenify/coding-standard)
[![Latest stable](https://img.shields.io/packagist/v/zenify/coding-standard.svg?style=flat-square)](https://packagist.org/packages/zenify/coding-standard)

Set of rules for [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) preferring tabs and based on [Nette coding standard](http://nette.org/en/coding-standard).

**Check [rules overview](docs/en/zenify-rules-overview.md) for examples.**


## Usage

Install the latest version via composer:

```sh
$ composer require zenify/coding-standard --dev
```

And run Php_CodeSniffer:

```sh
$ vendor/bin/phpcs src --standard=vendor/zenify/coding-standard/src/ZenifyCodingStandard/ruleset.xml
```

### PhpStorm integration

If you use PhpStorm, code sniffer can check your syntax as you write. [How to integrate?](docs/en/integration-to-php-storm.md)

## Other Nette related cs

- [Mikulas/code-sniffs](https://github.com/Mikulas/code-sniffs)
- [juzna/nette-coding-standard](https://github.com/juzna/nette-coding-standard)


## How to: own rules 

In case you want to create your own rules, here are some sources to start with:

- [Nice explanatory tutorial](http://blog.mayflower.de/631-Creating-coding-standards-for-PHP_CodeSniffer.html)
- [Overview of default rules with examples](http://edorian.github.io/php-coding-standard-generator/#phpcs)
- [Post on Why to add CS as part of your projects](http://edorian.github.io/2013-03-13-Please-ship-your-own-coding-standard-as-part/)
