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

use Facile\SymfonyFunctionalTestCase\WebTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CommandTest extends WebTestCase
{
    /**
     * This method tests both the default setting of `runCommand()` and the kernel reusing, as, to reuse kernel,
     * it is needed a kernel is yet instantiated. So we test these two conditions here, to not repeat the code.
     */
    public function testRunCommandWithoutOptionsAndReuseKernel(): void
    {
        // Run command without options
        $commandTester = $this->runCommand('liipfunctionaltestbundle:test');

        // Test default values
        $this->assertContains('Environment: test', $commandTester->getDisplay());
        $this->assertContains('Verbosity level: NORMAL', $commandTester->getDisplay());

        $this->assertInternalType('boolean', $this->getDecorated());
        $this->assertTrue($this->getDecorated());

        // Run command and reuse kernel
        $commandTester = $this->runCommand('liipfunctionaltestbundle:test', [], true);

        $this->assertInstanceOf(CommandTester::class, $commandTester);
        $this->assertSame(0, $commandTester->getStatusCode());

        $this->assertContains('Environment: test', $commandTester->getDisplay());
        $this->assertContains('Verbosity level: NORMAL', $commandTester->getDisplay());
    }

    public function testRunCommandWithoutOptionsAndNotReuseKernel(): void
    {
        // Run command without options
        $commandTester = $this->runCommand('liipfunctionaltestbundle:test');

        $this->assertInstanceOf(CommandTester::class, $commandTester);
        $this->assertSame(0, $commandTester->getStatusCode());

        // Test default values
        $this->assertContains('Environment: test', $commandTester->getDisplay());
        $this->assertContains('Verbosity level: NORMAL', $commandTester->getDisplay());

        $this->assertInternalType('boolean', $this->getDecorated());
        $this->assertTrue($this->getDecorated());

        // Run command and not reuse kernel
        $this->environment = 'prod';
        $commandTester = $this->runCommand('liipfunctionaltestbundle:test', [], true);

        $this->assertInstanceOf(CommandTester::class, $commandTester);

        $this->assertContains('Environment: prod', $commandTester->getDisplay());
        $this->assertContains('Verbosity level: NORMAL', $commandTester->getDisplay());
    }

    public function testRunCommandStatusCode(): void
    {
        $commandTester = $this->runCommand('liipfunctionaltestbundle:test-status-code');

        $this->assertInstanceOf(CommandTester::class, $commandTester);

        $this->assertSame(10, $commandTester->getStatusCode());
    }

    public function tearDown(): void
    {
        parent::tearDown();

        unset($commandTester);
    }
}
