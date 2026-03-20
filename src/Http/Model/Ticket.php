<?php

namespace App\Http\Model;

use DateTime;
use Ludens\Validation\Required;

class Ticket
{
    private int $id;
    private string $title;
    private string $description;
    private bool $active;
    private User $created_by;
    private User $attributed_to;
    private DateTime $created_at;

    public function id()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function title()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function description()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function active()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function createdBy()
    {
        return $this->created_by;
    }

    public function setCreatedBy($created_by)
    {
        $this->created_by = $created_by;
    }

    public function attributedTo()
    {
        return $this->attributed_to;
    }

    public function setAttributedTo($attributed_to)
    {
        $this->attributed_to = $attributed_to;
    }

    public function createdAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function hasOne()
    {
        return [
            'created_by' => User::class,
            'attributed_to' => User::class
        ];
    }

    public function rules()
    {
        return [
            'title' => [new Required('Le titre est obligatoire')],
            'description' => [new Required('La description est obligatoire')]
        ];
    }
}
