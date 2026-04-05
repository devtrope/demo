<?php

namespace App\Model;

use App\Rules\MinWords;
use DateTime;
use Ludens\Validation\Required;

class Ticket
{
    private int $id;
    private string $title;
    private string $description;
    private ?string $picture;
    private bool $active;
    private User $created_by;
    private User $attributed_to;
    private DateTime $created_at;

    public function id()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function title()
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function description()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function picture()
    {
        return $this->picture;
    }

    public function setPicture(?string $picture)
    {
        $this->picture = $picture;
    }

    public function active()
    {
        return $this->active;
    }

    public function setActive(bool $active)
    {
        $this->active = $active;
    }

    public function createdBy()
    {
        return $this->created_by;
    }

    public function setCreatedBy(User $created_by)
    {
        $this->created_by = $created_by;
    }

    public function attributedTo()
    {
        return $this->attributed_to;
    }

    public function setAttributedTo(User $attributed_to)
    {
        $this->attributed_to = $attributed_to;
    }

    public function createdAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $created_at)
    {
        $this->created_at = $created_at;
    }

    public function hasOne(): array
    {
        return [
            'created_by' => User::class,
            'attributed_to' => User::class
        ];
    }

    public function rules(): array
    {
        return [
            'title' => [
                new Required()
            ],
            'description' => [
                new Required(),
                new MinWords()
            ]
        ];
    }

    public function fillable(): array
    {
        return ['title', 'description'];
    }
}
