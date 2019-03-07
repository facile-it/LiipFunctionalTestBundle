<?php

declare(strict_types=1);

namespace Facile\SymfonyFunctionalTestCase\Tests\App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestStatusCodeCommand extends Command
{
    public function __construct()
    {
        parent::__construct('facileitsymfonyfunctionaltestcase:test-status-code');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return 10;
    }
}
