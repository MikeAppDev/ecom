<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Repository\RestaurantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
    public function show(string $slug, RestaurantRepository $repository, EntityManagerInterface $doctrine, SessionInterface $session): Response
    {
        //$entityManager = $doctrine->getManager();
        //$announce = $doctrine->getRepository(Announce::class)->find($id);
        $restaurant = $repository->findOneBy(['slug' => $slug]);
        $cart = $session->get('cart');
        $plats = $restaurant->getPlats();

        $plats = $plats->map(function(Plat $plat) use ($cart) {
            // Si le produit se trouve dans le panier
            //on lui ajoute la quantité du panier
            if (isset($cart[$plat->getId()])) {
                $plat->setQuantity($cart[$plat->getId()]['quantity']) ;
            }

            return $plat;
        });

        //dd($plats, $cart);

        if (!$restaurant) {
            throw $this->createNotFoundException("Le restaurant n'existe pas");
        }

        return $this->render('restaurant/show.html.twig', [
            'restaurant' => $restaurant,
            'slug' => $restaurant->getSlug(),
            'plats' => $plats
        ]);
    }
}
