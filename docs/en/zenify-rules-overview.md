# Zenify Rules Overview

Rules uses default numeric parameters (some can be changed to match your needs).

**TOC:**

- [1 Classes](#1-classes)
- [2 Commenting](#2-commenting)
- [3 Control Structures](#3-control-structures) 
- [4 Namespaces](#4-namespaces) 
- [5 Scope](#5-scope) 
- [6 WhiteSpace](#6-whitespace) 

---

## 1 Classes


### 1.1 ClassDeclarationSniff

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


### 1.2 OneClassPerFileApartExceptionsSniff

- Each class must be standalone file, apart exception classes

*Correct*

```php
class SomeClass
{

}


class SomeException extends \Exception
{

}
```

*Wrong*

```php
class SomeClass
{

}


class SomeOtherClass
{

}
```


## 2 Commenting


### 2.1 BlockPropertyCommentSniff

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


### 2.2 ComponentFactoryCommentSniff

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


## 3 Control Structures


### 3.1 ControlSignatureSniff

Same as Squiz_Sniffs_ControlStructures_ControlSignatureSniff, but with comments allowed.

```php
if (...) { // some comment 
```


### 3.2 NewClassSniff
 
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

### 3.3 SwitchDeclarationSniff

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


### 3.4 WeakTypeComparisonWithExplanationSniff

- Weak equals comparison should be commented with its purpose

*Correct*

```php
if ($i == TRUE) { // intentionally ==, failure proof
	return;
}

if ($i !== TRUE) {
	return;
}
```

*Wrong*

```php
if ($i == TRUE) {
	return;
}
```


## 4 Namespaces


### 4.1 NamespaceDeclarationSniff

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


### 4.2 UseDeclarationSniff 

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


## 5 Scope


### 5.1 MethodScopeSniff

- Function should have scope modifier
- Interface function should not have scope modifier

*Correct*

```php
class SomeClass
{

	public function run()
	{
	}

}
```

or

```php
interface SomeInterface
{

	function run();

}
```

*Wrong*

```php
class SomeClass
{

	function run()
	{
	}

}
```

or 

```php
interface SomeInterface
{

	public function run();

}
```


## 6 WhiteSpace
 

### 6.1 ConcatOperatorSniff

- ConcatOperator (.) should be surrounded by spaces

*Correct*

```php
$s = 'Ze' . 'n';
```

*Wrong*

```php
$s = 'Ze'.'n';
```


### 6.2 ExclamationMarkSniff

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


### 6.3 IfElseSniff

- Else/elseif statement should be preceded by empty line

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
if (1 === 2) {
	return 3;
} elseif (2 === 3) {
	return 4;
}
```


### 6.4 InBetweenExceptionSpacingSniff

- Class followed by exception or exceptions should have 2 empty lines between themselves

*Correct*

```php
class SomeClass
{

}


class SomeException extends \Exception
{

}


class SomeOtherException extends \Exception
{

}

```

*Wrong*

```php
class SomeClass
{

}

class SomeException extends \Exception
{

}

class SomeOtherException extends \Exception
{

}
```


### 6.5 InBetweenMethodSpacingSniff

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


### 6.6 PropertiesMethodsMutualSpacingSniff

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
