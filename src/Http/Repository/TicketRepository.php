<?php

namespace App\Http\Repository;

use App\Http\Model\Ticket;
use Ludens\Framework\AbstractRepository;

class TicketRepository extends AbstractRepository
{
    protected function getModel(): string
    {
        return Ticket::class;
    }

    public function getTable(): string
    {
        return 'tickets';
    }
}