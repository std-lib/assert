# Standard Assertions

**NOTE** This is a pre-v1.0.0 beta release.  Minor details may change soon, such as the exception class and/or other minor details.  However these should be,
with the exception of the exception class itself (as long as you do not rely on this particular implementation detail) backwards compatible.  No guarantees, 
though.

## How to use (quick start)

### Install

```sh
composer require std/assert
```

### Call anywhere (domain logic, entities, application, infrastructure...)

```php
    public function mySweetBusinessLogic(string $value) 
    {
        return substr($value, 0, 1); // We got a bug!
    }

    // Fixed!
    public function mySweetBusinessLogic(string $value) 
    {
        \Std\Assert::minLength($value, 1);
        return substr($value, 0, 1); // No longer have a bug!
    }
```

### Further Instructions

The assertion class is all static methods that throw `\InvalidArgumentException` if the supplied assertion **is NOT true**.  In other words, your assertion,
like a unit test, should be what the application expects.  Don't get confused -- if a value must be true, then you should call `Assert::true($val)`, not the
other way around.

This can be used as "simplified argument handling", as well as anywhere else.  It honestly took me a while to get used to calling assertions in this manner, as
they feel like unit tests, and perhaps initially awkward feeling because of this fact.  However, once you get used to the idea, you will understand their value
as a simple method to perform sanity checks throughout your system (particularly, in your domain/business logic).    

Every check within Webmozart has a corresponding "`all`" and "`nullOr`".  These are handled by a `__callStatic` magic method (nothing wrong with that!), and are
properly type-hinted and declared in the class docblock via `@method`.  

`allXXX`, for example `allNotEmpty` will assert that each element of the given **array** is "true" to the given test.  That is, `allNotEmpty` will assert that
each element of the given array is not empty.

`nullOrXXX` will, believe it or not, assert that the value may be either null or the given assertion.  For example, `nullOrEmail` will assert that the given 
value is either a valid e-mail address, or `=== null`.
   
## Webmozart & The future

This is effectively, and always will be, a clone of `Webmozart\Assert` by Bernhard Schussek <bschussek@gmail.com>

His package is available at `webmozart/assert` if you are interested, and this package currently relies upon it directly.  

# Original Documentation

Assertions
----------

The [`Assert`] class provides the following assertions:

### Type Assertions

Method                                                   | Description
-------------------------------------------------------- | --------------------------------------------------
`string($value, $message = '')`                          | Check that a value is a string
`stringNotEmpty($value, $message = '')`                  | Check that a value is a non-empty string
`integer($value, $message = '')`                         | Check that a value is an integer
`integerish($value, $message = '')`                      | Check that a value casts to an integer
`float($value, $message = '')`                           | Check that a value is a float
`numeric($value, $message = '')`                         | Check that a value is numeric
`natural($value, $message= ''')`                         | Check that a value is a non-negative integer
`boolean($value, $message = '')`                         | Check that a value is a boolean
`scalar($value, $message = '')`                          | Check that a value is a scalar
`object($value, $message = '')`                          | Check that a value is an object
`resource($value, $type = null, $message = '')`          | Check that a value is a resource
`isCallable($value, $message = '')`                      | Check that a value is a callable
`isArray($value, $message = '')`                         | Check that a value is an array
`isTraversable($value, $message = '')`  (deprecated)     | Check that a value is an array or a `\Traversable`
`isIterable($value, $message = '')`                      | Check that a value is an array or a `\Traversable`
`isCountable($value, $message = '')`                     | Check that a value is an array or a `\Countable`
`isInstanceOf($value, $class, $message = '')`            | Check that a value is an `instanceof` a class
`isInstanceOfAny($value, array $classes, $message = '')` | Check that a value is an `instanceof` a at least one class on the array of classes
`notInstanceOf($value, $class, $message = '')`           | Check that a value is not an `instanceof` a class
`isArrayAccessible($value, $message = '')`               | Check that a value can be accessed as an array
`uniqueValues($values, $message = '')`                   | Check that the given array contains unique values

### Comparison Assertions

Method                                          | Description
----------------------------------------------- | --------------------------------------------------
`true($value, $message = '')`                   | Check that a value is `true`
`false($value, $message = '')`                  | Check that a value is `false`
`null($value, $message = '')`                   | Check that a value is `null`
`notNull($value, $message = '')`                | Check that a value is not `null`
`isEmpty($value, $message = '')`                | Check that a value is `empty()`
`notEmpty($value, $message = '')`               | Check that a value is not `empty()`
`eq($value, $value2, $message = '')`            | Check that a value equals another (`==`)
`notEq($value, $value2, $message = '')`         | Check that a value does not equal another (`!=`)
`same($value, $value2, $message = '')`          | Check that a value is identical to another (`===`)
`notSame($value, $value2, $message = '')`       | Check that a value is not identical to another (`!==`)
`greaterThan($value, $value2, $message = '')`   | Check that a value is greater than another
`greaterThanEq($value, $value2, $message = '')` | Check that a value is greater than or equal to another
`lessThan($value, $value2, $message = '')`      | Check that a value is less than another
`lessThanEq($value, $value2, $message = '')`    | Check that a value is less than or equal to another
`range($value, $min, $max, $message = '')`      | Check that a value is within a range
`oneOf($value, array $values, $message = '')`   | Check that a value is one of a list of values

### String Assertions

You should check that a value is a string with `Assert::string()` before making
any of the following assertions.

Method                                              | Description
--------------------------------------------------- | -----------------------------------------------------------------
`contains($value, $subString, $message = '')`       | Check that a string contains a substring
`notContains($value, $subString, $message = '')`    | Check that a string does not contains a substring
`startsWith($value, $prefix, $message = '')`        | Check that a string has a prefix
`startsWithLetter($value, $message = '')`           | Check that a string starts with a letter
`endsWith($value, $suffix, $message = '')`          | Check that a string has a suffix
`regex($value, $pattern, $message = '')`            | Check that a string matches a regular expression
`notRegex($value, $pattern, $message = '')`         | Check that a string does not match a regular expression
`unicodeLetters($value, $message = '')`             | Check that a string contains Unicode letters only
`alpha($value, $message = '')`                      | Check that a string contains letters only
`digits($value, $message = '')`                     | Check that a string contains digits only
`alnum($value, $message = '')`                      | Check that a string contains letters and digits only
`lower($value, $message = '')`                      | Check that a string contains lowercase characters only
`upper($value, $message = '')`                      | Check that a string contains uppercase characters only
`length($value, $length, $message = '')`            | Check that a string has a certain number of characters
`minLength($value, $min, $message = '')`            | Check that a string has at least a certain number of characters
`maxLength($value, $max, $message = '')`            | Check that a string has at most a certain number of characters
`lengthBetween($value, $min, $max, $message = '')`  | Check that a string has a length in the given range
`uuid($value, $message = '')`                       | Check that a string is a valid UUID
`ip($value, $message = '')`                         | Check that a string is a valid IP (either IPv4 or IPv6)
`ipv4($value, $message = '')`                       | Check that a string is a valid IPv4
`ipv6($value, $message = '')`                       | Check that a string is a valid IPv6
`email($value, $message = '')`                      | Check that a string is a valid e-mail address
`notWhitespaceOnly($value, $message = '')`          | Check that a string contains at least one non-whitespace character

### File Assertions

Method                              | Description
----------------------------------- | --------------------------------------------------
`fileExists($value, $message = '')` | Check that a value is an existing path
`file($value, $message = '')`       | Check that a value is an existing file
`directory($value, $message = '')`  | Check that a value is an existing directory
`readable($value, $message = '')`   | Check that a value is a readable path
`writable($value, $message = '')`   | Check that a value is a writable path

### Object Assertions

Method                                                | Description
----------------------------------------------------- | --------------------------------------------------
`classExists($value, $message = '')`                  | Check that a value is an existing class name
`subclassOf($value, $class, $message = '')`           | Check that a class is a subclass of another
`interfaceExists($value, $message = '')`              | Check that a value is an existing interface name
`implementsInterface($value, $class, $message = '')`  | Check that a class implements an interface
`propertyExists($value, $property, $message = '')`    | Check that a property exists in a class/object
`propertyNotExists($value, $property, $message = '')` | Check that a property does not exist in a class/object
`methodExists($value, $method, $message = '')`        | Check that a method exists in a class/object
`methodNotExists($value, $method, $message = '')`     | Check that a method does not exist in a class/object

### Array Assertions

Method                                             | Description
-------------------------------------------------- | ------------------------------------------------------------------
`keyExists($array, $key, $message = '')`           | Check that a key exists in an array
`keyNotExists($array, $key, $message = '')`        | Check that a key does not exist in an array
`count($array, $number, $message = '')`            | Check that an array contains a specific number of elements
`minCount($array, $min, $message = '')`            | Check that an array contains at least a certain number of elements
`maxCount($array, $max, $message = '')`            | Check that an array contains at most a certain number of elements
`countBetween($array, $min, $max, $message = '')`  | Check that an array has a count in the given range
`isList($array, $message = '')`                    | Check that an array is a non-associative list
`isMap($array, $message = '')`                     | Check that an array is associative and has strings as keys

### Function Assertions

Method                                      | Description
------------------------------------------- | -----------------------------------------------------------------------------------------------------
`throws($closure, $class, $message = '')`   | Check that a function throws a certain exception. Subclasses of the exception class will be accepted.

### Collection Assertions

All of the above assertions can be prefixed with `all*()` to test the contents
of an array or a `\Traversable`:

```php
Assert::allIsInstanceOf($employees, 'Acme\Employee');
```

### Nullable Assertions

All of the above assertions can be prefixed with `nullOr*()` to run the
assertion only if it the value is not `null`:

```php
Assert::nullOrString($middleName, 'The middle name must be a string or null. Got: %s');
```

---

## Std\Assert

Back to `Std\Assert` ...

## Future 

In the future, I would like to:

 - Figure out a way to cleanly extend his work, but add a little more flexibility.  Particularly, add a "`not...()`" + "`allNot...()`".  Perhaps there is some
 anti-pattern or pattern I am missing here, but to simply assert something "is not a ..." is rather difficult.  This is obviously preferable.  If this just 
 can't be done cleanly, I'll have to fork instead.
 - Add a few more high-level assertions.
 - Using this same code, create a new package for more informal validation package (ex. define API input validation via schema).
 - Using a similar system, define similar assertions with a correction path.
 
## License

Most importantly, Webmozart is Copyright (c) 2014 Bernhard Schussek and released under the MIT license.

[Bernhard Schussek]: http://webmozarts.com
[The Community Contributors]: https://github.com/webmozart/assert/graphs/contributors
[issue tracker]: https://github.com/webmozart/assert/issues
[Git repository]: https://github.com/webmozart/assert

Any further additions or changes to his work within `Std\Assert` is freely available without attribution, available under any one of the following:

> (C) Copyright 2019; A.B. Carroll <ben@hl9.net>
  
 - Unlicense <http://unlicense.org> (No Attribution Required) 
 - MIT License
 - Apache 2.0 License 
 - BSD 2-clause License
 
Please be mindful and credit the author of `Webmozart\Assert` (Bernhard Schussek), as `Std\Assert` is based upon it.

