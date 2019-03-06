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

namespace Facile\SymfonyFunctionalTestCase\Tests;

use Facile\SymfonyFunctionalTestCase\Tests\AppConfigLeanFramework\AppConfigLeanFrameworkKernel;
use Facile\SymfonyFunctionalTestCase\WebTestCase;

/**
 * Test Lean Framework - with validator component disabled.
 *
 * Use Tests/AppConfigLeanFramework/AppConfigLeanFrameworkKernel.php instead of
 * Tests/App/AppKernel.php.
 * So it must be loaded in a separate process.
 *
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class WebTestCaseConfigLeanFrameworkTest extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return AppConfigLeanFrameworkKernel::class;
    }

    public function testAssertStatusCode(): void
    {
        $client = static::makeClient();

        $path = '/';
        $client->request('GET', $path);

        $this->assertStatusCode(200, $client);
    }
}
