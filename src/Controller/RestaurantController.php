<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RestaurantRepository;

class RestaurantController extends AbstractController
{
    #[Route('/restaurants', name: 'restaurants')]
    public function index(RestaurantRepository $repository): Response
    {

        $donnees = $repository->findAll();


        // Affichage de la vue
        return $this->render('restaurant/index.html.twig', [
            'donnees'=>$donnees
        ]);
    }
}
