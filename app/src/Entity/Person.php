<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonRepository::class)]
class Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 50)]
    private string $firstname;
    #[ORM\Column(type: 'string', length: 50)]
    private string $lastname;
    #[ORM\Column(type: 'integer', length: 10)]
    private int $day;
    #[ORM\Column(type: 'integer', length: 10)]
    private int $month;
    #[ORM\Column(type: 'integer', length: 10)]
    private ?int $year;
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $comment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getDay(): int
    {
        return $this->day;
    }

    public function getMonth(): int
    {
        return $this->month;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }
}
