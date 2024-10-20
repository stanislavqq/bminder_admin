<?php

namespace App\Controller;

use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/')]
    public function index(PersonRepository $personRepository) : Response
    {
        $persons = $personRepository->findAll();

        $values = [
            'persons' => $persons,
            "page_title" => "test"
        ];

        return $this->render('home/index.html.twig', $values);
    }
}