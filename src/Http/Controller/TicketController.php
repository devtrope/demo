<?php

namespace App\Http\Controller;

use App\Http\Model\Ticket;
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

    public function add(): void
    {
        $this->render('ticket/add.html.twig');
    }

    public function postAdd()
    {
        $ticket = new Ticket();
        $ticket->setTitle($_POST['title']);
        $ticket->setDescription($_POST['description']);
        $this->ticketRepository->save($ticket);
    }

    public function update(int $ticketId): void
    {
        $ticket = $this->ticketRepository->find($ticketId);
        $this->set('ticket', $ticket);
        $this->render('ticket/update.html.twig');
    }

    public function postUpdate()
    {
        $ticket = $this->ticketRepository->find($_POST['id']);
        $ticket->setTitle($_POST['title']);
        $ticket->setDescription($_POST['description']);
        $this->ticketRepository->save($ticket);
        $this->redirect('/');
    }
}
