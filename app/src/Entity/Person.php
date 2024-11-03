<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PersonRepository::class)]
class Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(type: 'string', length: 50)]
    public string $firstname;

    #[ORM\Column(type: 'string', length: 50)]
    public string $lastname;

    #[ORM\Column(type: 'integer', length: 10)]
    #[Assert\LessThanOrEqual(31)]
    #[Assert\NotNull(message: "Выберите день")]
    public int $day;

    #[ORM\Column(type: 'integer', length: 10)]
    #[Assert\LessThanOrEqual(12)]
    #[Assert\NotNull(message: "Выберите месяц")]
    public int $month;

    #[ORM\Column(type: 'integer', length: 10, nullable: true)]
    public ?int $year;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    public ?string $comment;

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

    public function getSort() : int
    {
        return  $this->month;
    }

    public function getDate() : \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromFormat("m-d", sprintf('%d-%d', $this->month, $this->day));
    }

    public function getDateString() : string
    {
        return $this->getDate()->format('d F');
    }

    public function getName() : string
    {
        return $this->firstname . " " . $this->lastname;
    }
}
