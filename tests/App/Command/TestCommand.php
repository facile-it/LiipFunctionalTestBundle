<?php

declare(strict_types=1);

namespace Facile\SymfonyFunctionalTestCase\Tests\App\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\Kernel;

class TestCommand extends ContainerAwareCommand
{
    private $container;

    protected function configure(): void
    {
        parent::configure();

        $this->setName('facileitsymfonyfunctionaltestcase:test')
            ->setDescription('Test command');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        parent::initialize($input, $output);

        $this->container = $this->getContainer();
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        // Symfony version check
        $version = Kernel::VERSION_ID;
        $output->writeln('Symfony version: '.$version);
        $output->writeln('Environment: '.$this->container->get('kernel')->getEnvironment());
        $output->writeln('Verbosity level set: '.$output->getVerbosity());

        $output->writeln('Environment: '.$this->container->get('kernel')->getEnvironment());
    }
}
