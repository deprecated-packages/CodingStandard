# Coding Standard

[![Build Status](https://img.shields.io/travis/Zenify/CodingStandard.svg?style=flat-square)](https://travis-ci.org/Zenify/CodingStandard)
[![Quality Score](https://img.shields.io/scrutinizer/g/Zenify/CodingStandard.svg?style=flat-square)](https://scrutinizer-ci.com/g/Zenify/CodingStandard)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/Zenify/CodingStandard.svg?style=flat-square)](https://scrutinizer-ci.com/g/Zenify/CodingStandard)
[![Downloads](https://img.shields.io/packagist/dt/zenify/coding-standard.svg?style=flat-square)](https://packagist.org/packages/zenify/coding-standard)
[![Latest stable](https://img.shields.io/packagist/v/zenify/coding-standard.svg?style=flat-square)](https://packagist.org/packages/zenify/coding-standard)

Set of rules for [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) preferring tabs and based on [Nette coding standard](http://nette.org/en/coding-standard).

**Check [rules overview](#rules-overview) for examples.**


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


---

## Rules Overview

Rules uses default numeric parameters (some can be changed to match your needs).

**TOC:**

- [1 Classes](#1-classes)
- [2 Commenting](#2-commenting)
- [3 Control Structures](#3-control-structures) 
- [4 Debug](#4-debug) 
- [5 Namespaces](#5-namespaces) 
- [6 Naming](#6-naming) 

---

### 1 Classes


#### ClassDeclarationSniff

- Opening brace for the class should be followed by 1 empty line
- Closing brace for the class should be preceded by 1 empty line

*Correct*

```php
class SomeClass
{

	public function run()
	{

	}

}
```

*Wrong*

```php
class SomeClass
{
	public function run()
	{

	}
}
```


#### FinalInterfaceSniff

- Non-abstract class that implements interface should be final.
- Except for Doctrine entities, they cannot be final.

*Correct*

```php
final class SomeClass implements SomeInterface
{

	public function run()
	{

	}

}
```

*Wrong*

```php
class SomeClass implements SomeInterface
{

	public function run()
	{

	}

}
```


### 2 Commenting


#### BlockPropertyCommentSniff

- Block comment should be used instead of one liner

*Correct*

```php
class SomeClass
{

	/**
	 * @var int
	 */
	public $count;

}
```

*Wrong*

```php
class SomeClass
{

	/** @var int */
	public $count;

}
```


#### ComponentFactoryCommentSniff

- CreateComponent* method should have a doc comment
- CreateComponent* method should have a return tag
- Return tag should contain type
 
*Correct*

```php
/**
 * @return DisplayComponent
 */
protected function createComponentDisplay()
{
	$this->displayComponentFactory->create();
}
```

*Wrong*

```php
protected function createComponentDisplay()
{
	$this->displayComponentFactory->create();
}
```


#### VarPropertyCommentSniff

- Property should have docblock comment.
 
*Correct*

```php
class SomeClass
{

	/**
	 * @var int
	 */
	private $someProperty;

}
```

*Wrong*

```php
class SomeClass
{

	private $someProperty;

}
```


#### MethodCommentSniff

- Method without parameter typehints should have docblock comment.

*Correct*

```php
class SomeClass
{

	/**
	 * @param int $values
	 */
	public function count($values)
	{
	}

}
```


```php
class SomeClass
{

	public function count(array $values)
	{
	}

}
```


*Wrong*

```php
class SomeClass
{

	public function count($values)
	{
	}

}
```


#### MethodCommentReturnTagSniff

- Getters should have @return tag or return type.

*Correct*

```php
class SomeClass
{

	/**
	 * @return int
	 */
	public function getResult()
	{
		// ...
	}

}
```


*Wrong*

```php
class SomeClass
{

	/**
	 * This will return something.
	 */
	public function getResult()
	{
	}

}
```


### 3 Control Structures


#### NewClassSniff
 
- New class statement should not have empty parentheses

*Correct*

```php
$someClass = new SomeNamespace\SomeClass;
$someClass = new SomeNamespace\SomeClass($keyHandler);
```

*Wrong*

```php
$someClass = new SomeNamespace\SomeClass();
```

#### SwitchDeclarationSniff

*Correct*

```php
$suit = 'case';

switch ($suit) {
	case 1:
		echo 'ok';
		break;
	default:
		echo 'not ok';
		break;
}
```

*Wrong*

```php
$suit = 'case';

switch ($suit) {
case 1:
	echo 'ok';
	break;
}
```


#### YodaConditionSniff

- Yoda condition should not be used; switch expression order

*Correct*

```php
if ($i === TRUE) {
	return;
}

$go = $decide === TRUE ?: FALSE;
```


*Wrong*

```php
if (TRUE === $i) {
	return;
}

$go = TRUE === $decide ?: FALSE;
```


### 4 Debug


#### DebugFunctionCallSniff

- Debug functions should not be left in the code

*Wrong*

```php
dump('It works');
```


### 5 Namespaces


#### NamespaceDeclarationSniff

- There must be 2 empty lines after the namespace declaration or 1 empty line followed by use statement.

*Correct*

```php
namespace SomeNamespace;

use PHP_CodeSniffer;


class SomeClass
{

}
```

or

```php
namespace SomeNamespace;


class SomeClass
{

}
```

*Wrong*

```php
namespace SomeNamespace;


use SomeNamespace;


class SomeClass
{

}
```

or

```php
namespace SomeNamespace;

class SomeClass
{

}
```


#### UseDeclarationSniff 

- There must be one USE keyword per declaration
- There must be 2 blank lines after the last USE statement

*Correct*

```php
namespace SomeNamespace;

use Sth;
use SthElse;


class SomeClass
{

}
```

*Wrong*

```php
namespace SomeNamespace;

use Sth, SthElse;

class SomeClass
{

}
```


### 6 Naming

#### AbstractClassNameSniff

- Abstract class should have prefix "Abstract"


*Correct*

```php
abstract class AbstractClass
{

}
```

*Wrong*

```php
abstract class SomeClass
{

}
```


#### InterfaceNameSniff

- Interface should have suffix "Interface"


*Correct*

```php
interface SomeInterface
{

}
```

*Wrong*

```php
interface Some
{

}
```


### 7 WhiteSpace
 

#### DocBlockSniff

- DocBlock lines should start with space (except first one)

*Correct*

```php
/**
 * Counts feelings.
 */
public function ...
```

*Wrong*

```php
/**
* Counts feelings.
*/
public function ...
```


#### ExclamationMarkSniff

- Not operator (!) should be surrounded by spaces

*Correct*

```php
if ( ! $s) {
	return $s;
}
```

*Wrong*

```php
if (!$s) {
	return $s;
}
```


#### IfElseTryCatchFinallySniff

- Else/elseif/catch/finally statement should be preceded by 1 empty line

*Correct*

```php
if ($i === 1) {
	return $i;

} else {
	return $i * 2;
}
```

*Wrong*

```php
try (1 === 2) {
	return 3;
} catch (2 === 3) {
	return 4;
} finally (2 === 3) {
	return 4;
}
```


#### InBetweenMethodSpacingSniff

- Method should have 2 empty lines after itself

*Correct*

```php
class SomeClass
{

	public function run()
	{
	}


	public function go()
	{
	}

}
```

*Wrong*

```php
class SomeClass
{

	public function run()
	{
	}

	public function go()
	{
	}

}
```


#### PropertiesMethodsMutualSpacingSniff

- Between properties and methods should be 2 empty lines

*Correct*

```php
class SomeClass
{

	private $jet;


	public function run()
	{
	}

}
```

*Wrong*

```php
class SomeClass
{

	private $jet;

	public function run()
	{
	}

}
```
