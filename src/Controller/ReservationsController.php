<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Reservation;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationsController extends AbstractController
{

    /*Liste des réservations*/ 

    #[Route('/reservations', name: 'reservations')]
    public function reservationListe( ReservationRepository $reservationRepository, Request $request , PaginatorInterface $paginator)
    {
        $data = new SearchData();
         
        $reservations = $reservationRepository->findAll($data);

        $pagination = $paginator->paginate(
            $reservationRepository->findAllReservation(),
            $request->query->get('page',1),
            10
        );


        $reservations_user = $reservationRepository->findByUser($this->getUser());

        return $this->render('reservations/reservations.html.twig', [
            "reservations" => $reservations,
            "reservations_user"=>$reservations_user,
            "pagination" => $pagination


        ]);
    }

    /*Création d'un réservation*/ 

    #[Route('reservations/create' , name: 'reservation_create')]

    public function reservationCreate( Request $request ,EntityManagerInterface $entityManager )
    {
        $reservation = new Reservation();
        $reservation->setUser($this->getUser());
        $reservationForm = $this->createForm(ReservationType::class,$reservation);
        $reservationForm->handleRequest($request);
        
        if ($reservationForm->isSubmitted() && $reservationForm->isValid()){
            
            $entityManager->persist($reservation);
            $entityManager->flush();
            $this->addFlash('success' , 'Réservation créé avec succès');
            
        }
        
        return $this->render('reservations/reservation_create.html.twig', [
            'reservationForm' => $reservationForm->createView()
        ]);
        
    }
}
