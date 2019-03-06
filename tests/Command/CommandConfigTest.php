<?php

declare(strict_types=1);

/*
 * This file is part of the Liip/FunctionalTestBundle
 *
 * (c) Lukas Kahwe Smith <smith@pooteeweet.org>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Facile\SymfonyFunctionalTestCase\Tests\Command;

use Facile\SymfonyFunctionalTestCase\Test\WebTestCase;
use Facile\SymfonyFunctionalTestCase\Tests\AppConfig\AppConfigKernel;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Use Tests/AppConfig/AppConfigKernel.php instead of
 * Tests/App/AppKernel.php.
 * So it must be loaded in a separate process.
 *
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class CommandConfigTest extends WebTestCase
{
    private $commandTester;

    protected static function getKernelClass(): string
    {
        return AppConfigKernel::class;
    }

    public function testRunCommand(): void
    {
        // Run command without options
        $this->commandTester = $this->runCommand('liipfunctionaltestbundle:test');

        $this->assertInstanceOf(CommandTester::class, $this->commandTester);

        // Test values from configuration
        $this->assertContains('Environment: test', $this->commandTester->getDisplay());
        $this->assertContains('Verbosity level: VERY_VERBOSE', $this->commandTester->getDisplay());

        $this->assertInternalType('boolean', $this->getDecorated());
        $this->assertFalse($this->getDecorated());
    }
}
