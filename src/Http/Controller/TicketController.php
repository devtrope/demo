<?php

namespace App\Http\Controller;

use App\Http\Model\Ticket;
use App\Http\Repository\TicketRepository;
use Ludens\Http\Request;

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

    public function add(): void
    {
        $this->render('ticket/add.html.twig');
    }

    public function postAdd(Request $request)
    {
        $ticket = new Ticket();
        $ticket->setTitle($request->data('title'));
        $ticket->setDescription($request->data('description'));
        $this->ticketRepository->save($ticket);
        $this->redirect('/');
    }

    public function update(int $ticketId): void
    {
        $ticket = $this->ticketRepository->find($ticketId);
        $this->set('ticket', $ticket);
        $this->render('ticket/update.html.twig');
    }

    public function postUpdate(Request $request)
    {
        $ticket = $this->ticketRepository->find($request->data('id'));
        $ticket->setTitle($request->data('title'));
        $ticket->setDescription($request->data('description'));
        $this->ticketRepository->save($ticket);
        $this->redirect('/');
    }
}
