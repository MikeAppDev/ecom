<?php

namespace App\Controller;

use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    #[Route('/restaurants', name: 'restaurants')]
    public function index(RestaurantRepository $repository): Response
    {

        $donnees = $repository->findAll();


        // Affichage de la vue
        return $this->render('restaurant/index.html.twig', [
            'donnees' => $donnees
        ]);
    }
}