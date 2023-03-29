<?php

namespace App\Controller;

use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'menu')]
    public function menuListe( PlatRepository $platRepository)
    {
        $menu = $platRepository->findAll();

        return $this->render('menu.html.twig', [
            'menu' => $menu
        ]);
    }
}
