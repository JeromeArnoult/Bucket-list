<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class ListController extends AbstractController
{
    #[Route('/list', name: 'list_wish')]
    public function list(WishRepository $wishRepository): Response
    {
        $wishes = $wishRepository->findBestWishes();

        return $this->render('list/list.html.twig',["wishes" => $wishes]);
    }
    #[Route('/list/details/{id}', name: 'list_details')]
    public function details (int $id, WishRepository $wishRepository): Response
    {
        $wish = $wishRepository->find($id);

        return $this->render('list/details.html.twig', ["wish" => $wish]);
    }
    #[Route('/list/create', name: 'list_create')]
    public function create (Request $request, EntityManagerInterface $entityManager): Response{

        $wish = new Wish();
        $wish->setDateCreated(new \DateTime());

        $wishForm = $this->createForm(WishType::class, $wish);

        $wishForm->handleRequest($request);

        if($wishForm ->isSubmitted() && $wishForm->isValid()) {
            $entityManager->persist($wish);
            $entityManager->flush();

            $this->addFlash('success','Wish added! Good job dude !');
            return $this->redirectToRoute('list_details', ['id' => $wish->getId()]);
        }

        return $this->render('list/create.html.twig', ['wishForm' => $wishForm->createView()]);
    }

    #[Route('list/cnx', name: 'list_cnx')]
    public function cnx(EntityManagerInterface $entityManager):Response {
        $wish = new Wish();

        //hydrate les proporty
        $wish->setTitle('Visit Australia');
        $wish->setDescription('descriptionTestdddsddsqdsfqddddddddddddddddd');
        $wish->setAuthor('TestAuthor2');
        $wish->setisPublished(false);
        $wish->setDateCreated(new \DateTime("- 10 month"));

        // Et on insert les données de mon objet serie en base
        $entityManager->persist($wish);
        $entityManager->flush();

        return $this->render('list/cnx.html.twig');

    }
}
