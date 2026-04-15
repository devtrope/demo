<?php

namespace App\Commands;

use Ludens\Console\Command;
use Ludens\Console\Support\Input;
use Ludens\Console\Support\Output;

class HelloCommand extends Command
{
    public function configure(): void
    {
        $this->addArgument('name');
    }

    public function execute(Input $input, Output $output): int
    {
        $output->success('Hello ' . $input->getArgument('name'));
        return Command::SUCCESS;
    }

    public static function getName(): string
    {
        return "app:hello";
    }

    public static function getDescription(): string
    {
        return "Say hello";
    }
}