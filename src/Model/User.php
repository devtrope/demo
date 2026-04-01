<?php

namespace App\Model;

use DateTime;

class User
{
    private int $id;
    private string $username;
    private string $password;
    private string $name;
    private string $first_name;
    private DateTime $created_at;

    public function id()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function username()
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function password()
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function name()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function firstName()
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name)
    {
        $this->first_name = $first_name;
    }

    public function createdAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $created_at)
    {
        $this->created_at = $created_at;
    }
}
