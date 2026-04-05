<?php

namespace App\Model;

use DateTime;
use Ludens\Framework\ModelInterface;

class User implements ModelInterface
{
    private int $id;
    private string $username;
    private string $password;
    private string $name;
    private string $first_name;
    private DateTime $created_at;

    public function id(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function firstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
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
        return [];
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
