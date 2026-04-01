<?php

namespace App\Repository;

use App\Model\History;
use Ludens\Framework\AbstractRepository;

class HistoryRepository extends AbstractRepository
{
    public function getModel(): string
    {
        return History::class;
    }

    public function getTable(): string
    {
        return 'histories';
    }

    public function getAllByTicket(int $ticketId): array
    {
        return $this->queryBuilder()->from($this->getTable())->select()->where('ticket = :ticket')->withParameter('ticket', $ticketId)->getResults();
    }
}
