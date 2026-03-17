<?php

namespace App\Http\Controller;

use App\Http\Repository\TicketRepository;

class HomeController extends BaseController
{
    public function __construct(
        private TicketRepository $ticketRepository
    ) {
    }

    public function index(): void
    {
        $this->set('tickets', $this->ticketRepository->getAllActive());
        $this->render('home/index.html.twig');
    }
}
