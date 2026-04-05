<?php

namespace App\Model;

use DateTime;
use Ludens\Framework\ModelInterface;

class History implements ModelInterface
{
    private int $id;
    private Ticket $ticket;
    private User $user;
    private string $history_text;
    private DateTime $created_at;

    public function id(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function ticket(): Ticket
    {
        return $this->ticket;
    }

    public function setTicket(Ticket $ticket): void
    {
        $this->ticket = $ticket;
    }

    public function user(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function historyText(): string
    {
        return $this->history_text;
    }

    public function setHistoryText(string $history_text): void
    {
        $this->history_text = $history_text;
    }

    public function createdAt(): DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function hasOne(): array
    {
        return [
            'ticket' => Ticket::class,
            'user' => User::class
        ];
    }

    public function rules(): array
    {
        return [];
    }

    public function fillable(): array
    {
        return [];
    }
}
