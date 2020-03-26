<?php

declare(strict_types=1);

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
        $commandTester = $this->runCommand('facileitsymfonyfunctionaltestcase:test');

        // Test default values
        $this->assertStringContainsString('Environment: test', $commandTester->getDisplay());

        // Run command and reuse kernel
        $commandTester = $this->runCommand('facileitsymfonyfunctionaltestcase:test', [], true);

        $this->assertInstanceOf(CommandTester::class, $commandTester);
        $this->assertSame(0, $commandTester->getStatusCode());

        $this->assertStringContainsString('Environment: test', $commandTester->getDisplay());
    }

    public function testRunCommandWithoutOptionsAndNotReuseKernel(): void
    {
        // Run command without options
        $commandTester = $this->runCommand('facileitsymfonyfunctionaltestcase:test');

        $this->assertInstanceOf(CommandTester::class, $commandTester);
        $this->assertSame(0, $commandTester->getStatusCode());

        // Test default values
        $this->assertStringContainsString('Environment: test', $commandTester->getDisplay());

        // Run command and not reuse kernel
        $this->environment = 'prod';
        $commandTester = $this->runCommand('facileitsymfonyfunctionaltestcase:test', [], true);

        $this->assertInstanceOf(CommandTester::class, $commandTester);

        $this->assertStringContainsString('Environment: prod', $commandTester->getDisplay());
    }

    public function testRunCommandStatusCode(): void
    {
        $commandTester = $this->runCommand('facileitsymfonyfunctionaltestcase:test-status-code');

        $this->assertInstanceOf(CommandTester::class, $commandTester);

        $this->assertSame(10, $commandTester->getStatusCode());
    }
}
