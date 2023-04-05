<?php

namespace App\Controller;

use App\Repository\RestaurantRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    #[Route('/restaurants/show/{slug}', name: 'restaurants/{slug}')]
    public function show(string $slug, RestaurantRepository $repository, EntityManagerInterface $doctrine): Response
    {
        //$entityManager = $doctrine->getManager();
        //$announce = $doctrine->getRepository(Announce::class)->find($id);
        $restaurant = $repository->findOneBy(['slug' => $slug]);

        if (!$restaurant) {
            throw $this->createNotFoundException("Le restaurant n'existe pas");
        }
        
        return $this->render('restaurant/show.html.twig', [
            'restaurant' => $restaurant,
            'slug' => $restaurant->getSlug(),
        ]);
    }
}
