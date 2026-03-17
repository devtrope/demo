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
        $ticket = $this->ticketRepository->find($ticketId);
        if (false === $ticket->active()) {
            throw new \Ludens\Exceptions\NotFoundException("Le ticket demandé n'existe pas");
        }
        $this->set('ticket', $ticket);
        $this->render('ticket/index.html.twig');
    }
}
