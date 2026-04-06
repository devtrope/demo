<?php

namespace App\Model;

use App\Rules\MinWords;
use DateTime;
use Ludens\Framework\ModelInterface;
use Ludens\Validation\MinLength;
use Ludens\Validation\Required;

class Ticket implements ModelInterface
{
    private int $id;
    private string $title;
    private string $description;
    private ?string $picture;
    private bool $active;
    private User $created_by;
    private User $attributed_to;
    private DateTime $created_at;

    public function id(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function picture(): null|string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): void
    {
        $this->picture = $picture;
    }

    public function active(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function createdBy(): User
    {
        return $this->created_by;
    }

    public function setCreatedBy(User $created_by): void
    {
        $this->created_by = $created_by;
    }

    public function attributedTo(): User
    {
        return $this->attributed_to;
    }

    public function setAttributedTo(User $attributed_to): void
    {
        $this->attributed_to = $attributed_to;
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
            'created_by' => User::class,
            'attributed_to' => User::class
        ];
    }

    public function rules(): array
    {
        return [
            'title' => [
                new Required(),
                new MinLength(3)
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
