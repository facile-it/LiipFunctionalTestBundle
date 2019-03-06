<?php

declare(strict_types=1);

namespace Facile\SymfonyFunctionalTestCase\Tests\App\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestStatusCodeCommand extends ContainerAwareCommand
{
    private $container;

    protected function configure(): void
    {
        parent::configure();

        $this->setName('facileitsymfonyfunctionaltestcase:test-status-code')
            ->setDescription('Test command');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        parent::initialize($input, $output);

        $this->container = $this->getContainer();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return 10;
    }
}
