# monomelodies/reflex
Reflection utilities for PHP8+

Reflex offers extensions for PHP's built in reflection classes. These offer
extra functionality for reflections, while respecting their respective
contracts.

## Installation

```sh
$ composer require monomelodies/reflex

```

## `Monomelodies\Reflex\ReflectionClass`
Wrapper for `ReflectionClass`.

## The `AnyCallable` class

```php
<?php

use Reflex\AnyCallable;

$reflection = AnyCallable::reflect($someCallable);

```

This method returns the correct reflection for any type of callable (function or
method). It also takes into account that in PHP, an abstract method is not
considered callable.

