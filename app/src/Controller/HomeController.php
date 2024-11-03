<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\PersonType;
use App\Repository\PersonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(PersonRepository $personRepository) : Response
    {
        $persons = $personRepository->getSortedPersons();

        $values = [
            "current_date" => (new \DateTimeImmutable())->format('d F'),
            'persons' => $persons,
            "page_title" => "Список дней рождений"
        ];

        return $this->render('home/index.html.twig', $values);
    }

    #[Route('/create', name: 'person.create')]
    public function create(Request $request, EntityManagerInterface $entityManager) : Response
    {
        $person = new Person();
        $form = $this->createForm(PersonType::class, $person);
        $values = [
            "page_title" => "Создать запись"
        ];

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            /** @var Person $person */
            $person = $form->getData();

            $entityManager->persist($person);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('home/person_form.html.twig', ['form' => $form->createView(), ...$values]);
    }

    #[Route('/edit/{id}', name: 'person.edit')]
    public function edit(int $id, Request $request, PersonRepository $personRepository, EntityManagerInterface $entityManager) : Response
    {
        $person = $personRepository->find($id);
        $form = $this->createForm(PersonType::class, $person);
        $values = [
            "id" => $person->getId(),
            "page_title" => "Изменить #" . $id . " " . $person->firstname
        ];

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Person $person */
            $person = $form->getData();

            $entityManager->persist($person);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('home/person_form.html.twig', ['form' => $form->createView(), ...$values]);
    }

    #[Route('/delete/{id}', name: 'person.delete')]
    public function delete(int $id, Request $request, PersonRepository $personRepository, EntityManagerInterface $entityManager) : Response
    {
        $person = $personRepository->find($id);
        $entityManager->remove($person);
        $entityManager->flush();
        return $this->redirectToRoute('home');
    }
}