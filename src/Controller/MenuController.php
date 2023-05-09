<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Form\MenuType;
use App\Repository\MenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    /*Liste des menus*/ 

    #[Route('/menu', name: 'menus_liste')]
    public function menuListe( MenuRepository $menuRepository)
    {
        $menus = $menuRepository->findAll();

        return $this->render('menu/menu.html.twig', [
            'menus' => $menus
        ]);
    }

    /*Creation des menus*/ 

    #[Route('admin/menu/create', name:'menu_create')]
    public function MenuCreate(Request $request , EntityManagerInterface $entityManager,)
    {
        $menu = new Menu();
        $menuForm = $this->createForm(MenuType::class,$menu);
        $menuForm->handleRequest($request);

        if($menuForm->isSubmitted() && $menuForm->isValid()){
            $entityManager->persist($menu);
            $entityManager->flush();
            $this->addFlash('success' , 'Menu créé avec succès');
        }
        return $this->render('admin/menu_create.html.twig',[
            'menuForm' => $menuForm->createView()
        ]);
    }

    /*Suppression des menus*/ 


    #[Route('/admin/manu/{id}/delete', name: 'menu_delete')]

    public function menuDelete ($id , MenuRepository $menuRepository , EntityManagerInterface $entityManager)
    {
        $menu = $menuRepository->find($id);

        $entityManager->remove($menu);
        $entityManager->flush();

        return $this->redirectToRoute('menus_liste');
        $this->addFlash('warning', 'Menu supprimé avec succés');
    }

    /*Mise a jour des menus*/ 

    #[Route('/admin/menu/{id}/update', name: 'menu_update')]

    public function menuUpdate($id, Request $request, EntityManagerInterface $entityManager, MenuRepository $menuRepository)
    {
        $menu = $menuRepository->find($id);

        $menuForm = $this->createForm(menuType::class,$menu);

        $menuForm->handleRequest($request);

        if ($menuForm->isSubmitted() && $menuForm->isValid()){
            $entityManager->persist($menu);
            $entityManager->flush();
            $this->addFlash('success', 'Menu Modifié avec succées');

            return $this->redirectToRoute('menus_liste');
        }

        return $this->render('/admin/menu_create.html.twig',[
            'menuForm' => $menuForm->createView()
        ]);
    }
}
