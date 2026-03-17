<?php

namespace App\Http\Controller;

use App\Http\Repository\TicketRepository;

class TicketController extends BaseController
{
    public function __construct(
        private TicketRepository $ticketRepository
    ) {
    }

    public function index(int $ticketId): void
    {
        $ticket = $this->ticketRepository->findOrNull($ticketId);
        if (null === $ticket || false === $ticket->active()) {
            throw new \Ludens\Exceptions\NotFoundException();
        }
        $this->set('ticket', $ticket);
        $this->render('ticket/index.html.twig');
    }
}
