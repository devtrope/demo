<?php

namespace App\Http\Services;

use App\Http\Model\History;
use App\Http\Model\Ticket;
use App\Http\Model\User;
use App\Http\Repository\HistoryRepository;

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