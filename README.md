# facile-it/symfony-functional-testcase

![Build status](https://github.com/facile-it/symfony-functional-testcase/workflows/CI/badge.svg)
[![Latest Stable Version](https://poser.pugx.org/facile-it/symfony-functional-testcase/v/stable)](https://packagist.org/packages/facile-it/symfony-functional-testcase)
[![Latest Unstable Version](https://poser.pugx.org/facile-it/symfony-functional-testcase/v/unstable)](https://packagist.org/packages/facile-it/symfony-functional-testcase)
[![Codecov coverage status](https://codecov.io/gh/facile-it/symfony-functional-testcase/branch/master/graph/badge.svg)](https://codecov.io/gh/facile-it/symfony-functional-testcase)

This is a small base TestCase for PHPUnit functional tests in Symfony that provides a simple `getContainer()` helper, 
alongside with some small caching to speed up the tests. 

Forked (and slimmed down) from [liip/LiipFunctionalTestBundle](https://github.com/liip/LiipFunctionalTestBundle). 

# Installation
```bash
$ composer require --dev facile-it/symfony-functional-testcase
```

# Usage
To use this in one of your functional tests, you just have to edit it like this:

```diff
<?php

namespace Tests;

-use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
+use Facile\SymfonyFunctionalTestCase\WebTestCase;

class SomeTest extends WebTestCase
{
```

# Functionalities

#### Check HTTP status codes

##### isSuccessful()

Check that the request succedded:

```php
$client = $this->makeClient();
$client->request('GET', '/contact');

// Successful HTTP request
$this->isSuccessful($client->getResponse());
```

Add `false` as the second argument in order to check that the request failed:

```php
$client = $this->makeClient();
$client->request('GET', '/error');

// Request returned an error
$this->isSuccessful($client->getResponse(), false);
```

In order to test more specific status codes, use `assertStatusCode()`:

##### assertStatusCode()

Check the HTTP status code from the request:

```php
$client = $this->makeClient();
$client->request('GET', '/contact');

// Standard response for successful HTTP request
$this->assertStatusCode(302, $client);
```

## Command Tests
TODO document `runCommand`
