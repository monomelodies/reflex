# Monomelodies/Reflex
Reflection utilities for PHP5+

Reflex aims to offer a bunch of utilities for working with reflections I often
found myself (re)implementing in various projects. Hopefully they'll come in
handy for someone :)

## Installation

```sh
$ composer require monomelodies/reflex

```

## The `AnyCallable` class

```php
<?php

use Reflex\AnyCallable;

$reflection = AnyCallable::reflect($someCallable);

```

This method returns the correct reflection for any type of callable (function or
method). It also takes into account that in PHP, an abstract method is not
considered callable.

