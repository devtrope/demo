<?php

namespace App\Http\Controller;

use App\Http\Repository\TicketRepository;
use Ludens\Http\Response;

class HomeController extends BaseController
{
    public function __construct(
        private TicketRepository $ticketRepository
    ) {
        parent::__construct();
    }

    public function index(): Response
    {
        return $this->view('home/index.html.twig', [
            'tickets' => $this->ticketRepository->getAllActive()
        ]);
    }
}
