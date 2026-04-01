<?php

namespace App\Repository;

use App\Model\Ticket;
use Ludens\Framework\AbstractRepository;

class TicketRepository extends AbstractRepository
{
    public function getModel(): string
    {
        return Ticket::class;
    }

    public function getTable(): string
    {
        return 'tickets';
    }

    public function getAllActive(): array
    {
        return $this->queryBuilder()->from($this->getTable())->select()->where('active = 1')->getResults();
    }
}
