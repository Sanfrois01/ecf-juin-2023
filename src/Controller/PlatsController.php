<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Plat;
use App\Form\PlatType;
use App\Form\SearchType;
use App\Repository\PlatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PlatsController extends AbstractController

{
    /*Liste des plats*/ 

    #[Route('/plats', name: 'plats_liste')]
    public function platsListe( PlatRepository $platRepository , Request $request)
    {
        $data = new SearchData();
        $data->page = $request->get('page', 1);

        $form = $this->createForm(SearchType::class , $data);
        $form->handleRequest($request);
        $plats = $platRepository->findSearch($data);
        
        if($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('plats/_plats.html.twig',['plats' => $plats])
            ]);
        }

        return $this->render('plats/plats.html.twig', [
            'plats' => $plats,
            'form' => $form->createView()
        

        ]);
    }

    /*Suppression de plats*/ 

    #[Route('/admin/plats/{id}/delete', name: 'plats_delete')]

    public function platDelete ($id , PlatRepository $platRepository , EntityManagerInterface $entityManager)
    {
        $plat = $platRepository->find($id);

        $entityManager->remove($plat);
        $entityManager->flush();

        return $this->redirectToRoute('plats_liste');
        $this->addFlash('success', 'Plat supprimé avec succés');
    }

    /*Création de plat*/ 

    #[Route('/admin/plats/create', name: 'plats_create')]

    public function platCreate(Request $request , EntityManagerInterface $entityManager) 
    {
        $plat = new Plat();
        $platForm = $this->createForm(PlatType::class,$plat);
        $platForm->handleRequest($request);

        if ($platForm->isSubmitted() && $platForm->isValid()){

            /** @var UploadedFile|null $imgPlatFile */
            $imgPlatFile = $platForm->get('img_plat')->getData();

            if ($imgPlatFile){

                $newFilename = '-'.uniqid().'.'.$imgPlatFile->guessExtension();

                try{
                    $imgPlatFile->move(
                        $this->getParameter('plats_directory'),
                        $newFilename
                    );
                }catch (FileException $e){
                    $this->addFlash('error', $e->getMessage());
                }
                $plat->setImgPlat($newFilename);
            }
            $entityManager->persist($plat);
            $entityManager->flush();
            $this->addFlash('success' , 'Plat créé avec succès');


            return $this->redirectToRoute('plats_create');
        }


        return $this->render('/admin/plat_create.html.twig',[
            'platForm' => $platForm->createView()
        ]);
    }

    /*Mise a jour des plats*/ 

    #[Route('/admin/plats/{id}/update', name: 'plats_update')]

    public function platUpdate($id, Request $request, EntityManagerInterface $entityManager, PlatRepository $platRepository)
    {
        $plat = $platRepository->find($id);

        $platForm = $this->createForm(PlatType::class,$plat);

        $platForm->handleRequest($request);

        if ($platForm->isSubmitted() && $platForm->isValid()){
            $entityManager->persist($plat);
            $entityManager->flush();
            $this->addFlash('success', 'Plat Modifié avec succées');

            return $this->redirectToRoute('plats_liste');
        }

        return $this->render('/admin/plat_create.html.twig',[
            'platForm' => $platForm->createView()
        ]);
    }
}
