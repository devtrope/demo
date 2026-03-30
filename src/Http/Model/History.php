<?php

namespace App\Http\Model;

use DateTime;

class History
{
    private int $id;
    private Ticket $ticket;
    private User $user;
    private string $history_text;
    private DateTime $created_at;

    public function id()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function ticket()
    {
        return $this->ticket;
    }

    public function setTicket(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function user()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function historyText()
    {
        return $this->history_text;
    }

    public function setHistoryText(string $history_text)
    {
        $this->history_text = $history_text;
    }

    public function createdAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $created_at)
    {
        $this->created_at = $created_at;
    }

    public function hasOne()
    {
        return [
            'ticket' => Ticket::class,
            'user' => User::class
        ];
    }
}
