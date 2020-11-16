# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).
## Unreleased
 * ...
 
## 1.0.0 [2020-11-16]
 * Bump requirement to PHP 7.2

## 0.1.4 [2020-06-12]
 * Add `prepareCommandTester`, to be used in place of `runCommand` to obtain the `CommandTester` before the `execute` call [b941c50](https://github.com/facile-it/symfony-functional-testcase/commit/b941c500a270acdd34c8479440d3c710ca667d1f)

## 0.1.3 [2020-03-27]
 * Fix Symfony 5 compatibility [#3](https://github.com/facile-it/symfony-functional-testcase/pull/3)
 * Improve CI testing [#3](https://github.com/facile-it/symfony-functional-testcase/pull/3)
 * Switch to Codecov for coverage collection [#4](https://github.com/facile-it/symfony-functional-testcase/pull/4)
 * Increase PHPStan level to maximum (8) [0952653](https://github.com/facile-it/symfony-functional-testcase/commit/095265358f7494ed95cd0c4fc20fe6e38e5f72fe)

## 0.1.2 [2020-02-24]
### Added
 * Adds Symfony 5 compatibility [#2](https://github.com/facile-it/symfony-functional-testcase/pull/2)

## 0.1.1 [2019-03-13]
### Added
 * Add a third string optional parameter to `WebTestCase::assertStatusCode` as a custom failure message 

## 0.1 [2019-03-08]
First release.

This is a slimmed down fork of the LiipFunctionalTestBundle, where only some useful methods from the WebTestCase is retained.
