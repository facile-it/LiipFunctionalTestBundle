<?php

declare(strict_types=1);

namespace Facile\SymfonyFunctionalTestCase\Tests\Test;

use Facile\SymfonyFunctionalTestCase\Tests\App\AppKernel;
use Facile\SymfonyFunctionalTestCase\WebTestCase;
use PHPUnit\Framework\AssertionFailedError;
use Symfony\Component\DependencyInjection\ContainerInterface;

class WebTestCaseTest extends WebTestCase
{
    public function setUp(): void
    {
        static::$class = AppKernel::class;
    }

    public static function getKernelClass(): string
    {
        return AppKernel::class;
    }

    public function testGetContainer(): void
    {
        $this->assertInstanceOf(ContainerInterface::class, $this->getContainer());
    }

    /**
     * Call methods from Symfony to ensure the Controller works.
     */
    public function testIndex(): void
    {
        $path = '/';
        $client = static::createClient();

        $crawler = $client->request('GET', $path);

        $this->assertSame(1, $crawler->filter('html > body')->count());

        $this->assertSame(
            'Not logged in.',
            $crawler->filter('p#user')->text()
        );

        $this->assertSame(
            'LiipFunctionalTestBundle',
            $crawler->filter('h1')->text()
        );
    }

    /**
     * @depends testIndex
     */
    public function testIndexAssertStatusCode(): void
    {
        $path = '/';
        $client = static::createClient();

        $client->request('GET', $path);

        $this->assertStatusCode(200, $client);
    }

    public function testAssertStatusCodeFail(): void
    {
        $path = '/';
        $client = static::createClient();

        $client->request('GET', $path);

        try {
            $this->assertStatusCode(-1, $client);
        
            $this->fail('Test failed, no exception thrown');
        } catch (AssertionFailedError $e) {
            $this->assertStringStartsWith(
                'HTTP/1.1 200 OK',
                $e->getMessage()
            );

            $this->assertStringEndsWith(
                'Failed asserting that 200 matches expected -1.',
                $e->getMessage()
            );
        }
    }

    public function test404Error(): void
    {
        $path = '/missing_page';
        $client = static::createClient();

        $client->request('GET', $path);

        $this->assertStatusCode(404, $client);
        $this->isSuccessful($client->getResponse(), false);
    }

    public function testJsonIsSuccessful(): void
    {
        $client = static::createClient();

        $path = '/json';

        $client->request('GET', $path);

        $this->isSuccessful(
            $client->getResponse(),
            true,
            'application/json'
        );
    }
}
