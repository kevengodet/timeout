# keven/timeout

## Installation

```shell
$ composer require keven/timeout
```

## Usage

```php
<?php

use Keven\Timeout\Invoker;

$timeout = new Invoker;

// Execute code in under 2s, or throws an exception
$timeout(function() { sleep(1); return 'ok'; }, 2);
```
