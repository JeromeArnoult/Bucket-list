<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class ListController extends AbstractController
{
    #[Route('/list', name: 'list_todo')]
    public function list(): Response
    {
        //Todo : Aller chercher les wishes/todo en BDD
        return $this->render('list/list.html.twig', [

        ]);
    }
    #[Route('/list/details/{id}', name: 'list_details')]
    public function details (int $id): Response
    {
        //Todo : Aller chercher les wishes/todo en BDD
        return $this->render('list/details.html.twig', [

        ]);
    }
    #[Route('/list/create', name: 'list_create')]
    public function create (): Response
    {

        return $this->render('list/create.html.twig', [

        ]);
    }
}
