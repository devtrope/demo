<?php

namespace App\Controller;

use App\Model\Ticket;
use App\Repository\HistoryRepository;
use App\Repository\TicketRepository;
use App\Repository\UserRepository;
use App\Services\HistoryService;
use Ludens\Http\Request;
use Ludens\Http\Response;

class TicketController extends BaseController
{
    public function __construct(
        private TicketRepository $ticketRepository,
        private UserRepository $userRepository,
        private HistoryRepository $historyRepository,
        private HistoryService $historyService
    ) {
        parent::__construct();
    }

    public function index(int $ticketId): Response
    {
        $ticket = $this->ticketRepository->findOrNull($ticketId);
        if (null === $ticket || false === $ticket->active()) {
            throw new \Ludens\Exceptions\System\NotFoundException();
        }
        return $this->view('ticket/index.html.twig', [
            'ticket' => $ticket,
            'histories' => $this->historyRepository->getAllByTicket($ticketId)
        ]);
    }

    public function add(): Response
    {
        return $this->view('ticket/add.html.twig', [
            'users' => $this->userRepository->all()
        ]);
    }

    public function postAdd(Request $request): Response
    {
        $ticket = new Ticket();
        $request->validate($ticket);

        $ticket->setTitle($request->data('title'));
        $ticket->setDescription($request->data('description'));
        if ($request->hasFile('picture')) {
            $ticket->setPicture($request->image('picture')->upload());
        }
        $ticket->setCreatedBy($this->userRepository->find($this->currentAuth()->id()));
        $ticket->setAttributedTo($this->userRepository->find($request->data('attributed')));
        $ticket = $this->ticketRepository->save($ticket);
        
        $this->historyService->insert('Création du ticket', $ticket, $this->currentAuth());

        $this->success('Le ticket a bien été ajouté');
        return $this->redirect('/');
    }

    public function update(int $ticketId): Response
    {
        return $this->view('ticket/update.html.twig', [
            'ticket' => $this->ticketRepository->find($ticketId),
            'users' => $this->userRepository->all()
        ]);
    }

    public function postUpdate(Request $request): Response
    {
        $ticket = $this->ticketRepository->find($request->data('id'));
        $request->validate($ticket);

        $ticket->setTitle($request->data('title'));
        $ticket->setDescription($request->data('description'));
        if ($request->hasFile('picture')) {
            $ticket->setPicture($request->image('picture')->upload());
        }
        $ticket->setAttributedTo($this->userRepository->find($request->data('attributed')));
        $this->ticketRepository->save($ticket);

        $this->historyService->insert('Modification du ticket', $ticket, $this->currentAuth());

        $this->success('Le ticket a bien été mis à jour');
        return $this->redirect('/');
    }

    public function delete(int $ticketId): Response
    {
        $ticket = $this->ticketRepository->find($ticketId);
        $ticket->setActive(false);
        $this->ticketRepository->save($ticket);

        $this->historyService->insert('Suppression du ticket', $ticket, $this->currentAuth());
        
        $this->success('Le ticket a bien été supprimé');
        return $this->redirect('/');
    }
}
