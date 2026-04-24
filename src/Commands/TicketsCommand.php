<?php

namespace App\Commands;

use App\Repository\TicketRepository;
use Ludens\Console\Command;
use Ludens\Console\Support\Input;
use Ludens\Console\Support\InputArgument;
use Ludens\Console\Support\Output;

class TicketsCommand extends Command
{
    public function __construct(private TicketRepository $ticketRepository)
    {}

    public function configure(): void
    {
        $this->addArgument('id', InputArgument::OPTIONAL);
    }

    public function execute(Input $input, Output $output): int
    {
        $tickets = $this->ticketRepository->getAllActive();
        if (null !== $input->getArgument('id')) {
            $tickets = $this->ticketRepository->findOrNull($input->getArgument('id'));
            if (null === $tickets) {
                $output->error("Le ticket demandé n'existe pas");
                return Command::ERROR;
            }
            $tickets = [$tickets];
        }
        foreach ($tickets as $ticket) {
            $output->info($ticket->title());
        }
        return Command::SUCCESS;
    }

    public static function getName(): string
    {
        return "app:tickets";
    }

    public static function getDescription(): string
    {
        return "List all the tickets titles";
    }
}