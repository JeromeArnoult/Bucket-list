<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Attribute\Route;


class MainController extends AbstractController
{

   #[Route('/', name:'main_home')]
    public function home()
    {
        return $this->render('main/home.html.twig');
    }
    #[Route('/aboutUs', name:'main_aboutUs')]
    public function aboutUs(KernelInterface $kernel) : Response
    {
        $creatorsInfo = file_get_contents($kernel->getProjectDir(). '/data/team.json');
        $json = json_decode($creatorsInfo, true);

        return $this->render('main/aboutUs.html.twig',['creators' =>$json]);
    }
}