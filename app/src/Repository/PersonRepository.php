<?php

namespace App\Repository;

use App\Entity\Person;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Person>
 */
class PersonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Person::class);
    }

    /**
     * @return array|Person[]
     */
    public function getSortedPersons() : array
    {
        $persons = $this->findBy([], ['month' => 'ASC', 'day' => 'ASC']);
        $current = new \DateTimeImmutable();
        usort($persons, function ($a, $b) use ($current) {
            return $a->getDate()->getTimestamp() < $current->getTimestamp() ? 1 : 0;
        });
        return $persons;
    }
}
