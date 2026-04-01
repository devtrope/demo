<?php

namespace App\Services;

use App\Model\History;
use App\Model\Ticket;
use App\Model\User;
use App\Repository\HistoryRepository;

class HistoryService
{
    public function __construct(
        private HistoryRepository $historyRepository = new HistoryRepository()
    ) {
    }

    public function insert(string $message, Ticket $ticket, User $user)
    {
        $history = new History();
        $history->setTicket($ticket);
        $history->setUser($user);
        $history->setHistoryText($message);
        $this->historyRepository->save($history);
    }
}