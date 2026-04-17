<?php

namespace App\Commands;

use App\Repository\TicketRepository;
use Ludens\Console\Command;
use Ludens\Console\Support\Input;
use Ludens\Console\Support\Output;

class TicketsCommand extends Command
{
    public function __construct(private TicketRepository $ticketRepository)
    {}

    public function execute(Input $input, Output $output): int
    {
        $tickets = $this->ticketRepository->getAllActive();
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