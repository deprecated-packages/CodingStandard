# Zenify/CodingStandard

[![Build Status](https://img.shields.io/travis/Zenify/CodingStandard.svg?style=flat-square)](https://travis-ci.org/Zenify/CodingStandard)
[![Quality Score](https://img.shields.io/scrutinizer/g/Zenify/CodingStandard.svg?style=flat-square)](https://scrutinizer-ci.com/g/Zenify/CodingStandard)
[![Downloads this Month](https://img.shields.io/packagist/dm/zenify/coding-standard.svg?style=flat-square)](https://packagist.org/packages/zenify/coding-standard)
[![Latest stable](https://img.shields.io/packagist/v/zenify/coding-standard.svg?style=flat-square)](https://packagist.org/packages/zenify/coding-standard)

Set of rules for [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) based on [PGS-2](http://www.php-fg.org/pgs-2/) and [Nette CS](http://nette.org/en/coding-standard).

Oppose to the most default rules you can change all numerical parameters.

**Check [rules overview](docs/en/zenify-rules-overview.md) for examples.**


## Usage

Install the latest version via composer:

```sh
$ composer require zenify/coding-standard --dev
```

And run Php_CodeSniffer:

```sh
$ vendor/bin/phpcs src --standard=vendor/zenify/coding-standard/src/ZenifyCodingStandard/code-sniffer-ruleset.xml
```

### PhpStorm integration

If you use PhpStorm, code sniffer can check your syntax as you write. [How to integrate?](docs/en/integration-to-php-storm.md)

## Other PGS-2 related cs

- [Mikulas/code-sniffs](https://github.com/Mikulas/code-sniffs)
- [juzna/nette-coding-standard](https://github.com/juzna/nette-coding-standard)


## How to: own rules 

In case you want to create your own rules, here are some sources to start with:

- [Nice explanatory tutorial](http://blog.mayflower.de/631-Creating-coding-standards-for-PHP_CodeSniffer.html)
- [Overview of default rules with examples](http://edorian.github.io/php-coding-standard-generator/#phpcs)
- [Post on Why to add CS as part of your projects](http://edorian.github.io/2013-03-13-Please-ship-your-own-coding-standard-as-part/)


---


## Other commands

### [Copy/Paste Detector](https://github.com/sebastianbergmann/phpcpd)

Simple package by PhpUnit author Sebastian Bergmann, that detects duplicated code.

To test `src` folder, just run:

```sh
$ vendor/bin/phpcpd src
```

Or with no options to see documentation


### [PHP Mess Detector](https://github.com/phpmd/phpmd)

Rules are nicely [explained here](http://edorian.github.io/php-coding-standard-generator/#phpmd).

To test `src` folder with `text` output, just run. 

```sh
$ vendor/bin/phpmd src text ruleset=vendor/zenify/coding-standard/src/ZenifyCodingStandard/mess-detector-ruleset.xml  
```

Or with no options to see documentation.


### [PHP Depend](https://github.com/pdepend/pdepend/)

To test `src` folder just run. 

```sh
$ vendor/bin/pdepend --summary-xml="pdepend-summary.xml" src   
```
