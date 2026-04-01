<?php

namespace App\Http\Controller;

use App\Http\Model\History;
use App\Http\Model\Ticket;
use App\Http\Repository\HistoryRepository;
use App\Http\Repository\TicketRepository;
use App\Http\Repository\UserRepository;
use App\Http\Services\HistoryService;
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
        $validation = $request->validate($ticket);
        if (null !== $validation) {
            $this->error($validation);
            $this->flash($request->all());
            return $this->redirect('/ticket/add');
        }

        $ticket->setTitle($request->data('title'));
        $ticket->setDescription($request->data('description'));
        if (null !== $request->data('picture')) {
            $picture = $request->image($request->data('picture'));
            $ticket->setPicture($picture);
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
        $validation = $request->validate($ticket);
        if (null !== $validation) {
            $this->error($validation);
            $this->flash($request->all());
            return $this->redirect('/ticket/update/' . $request->data('id'));
        }

        $ticket->setTitle($request->data('title'));
        $ticket->setDescription($request->data('description'));
        if (null !== $request->data('picture')) {
            $picture = $request->image($request->data('picture'));
            $ticket->setPicture($picture);
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
