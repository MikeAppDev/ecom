<?php

namespace App\Controller;

use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends AbstractController
{

// #[Route('/restaurants', name: 'restaurants')]
    public function index(RestaurantRepository $repository): Response
    {
        // Affichage de la vue
        return $this->render('default/homepage.html.twig');
    }
}