<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Entity\Restaurant;
use App\Form\RestaurantType;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/resto')]
class RestoController extends AbstractController
{
    #[Route('/', name: 'app_resto_index', methods: ['GET'])]
    public function index(RestaurantRepository $restaurantRepository): Response
    {
        return $this->render('resto/index.html.twig', [
            'restaurants' => $restaurantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_resto_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RestaurantRepository $restaurantRepository): Response
    {
        $restaurant = new Restaurant();
        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $restaurantRepository->save($restaurant, true);

            return $this->redirectToRoute('app_resto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('resto/new.html.twig', [
            'restaurant' => $restaurant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_resto_show', methods: ['GET'])]
    public function show(Restaurant $restaurant, SessionInterface $session, Plat $plat): Response
    {
        $cart = $session->get('cart');

        if (isset($cart[$plat->getId()])){
            $quantity = $cart[$plat->getId()];
        }

        return $this->render('resto/show.html.twig', [
            'restaurant' => $restaurant,
            'quantity' => $quantity
        ]);
    }

    #[Route('/{id}/edit', name: 'app_resto_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Restaurant $restaurant, RestaurantRepository $restaurantRepository): Response
    {
        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $restaurantRepository->save($restaurant, true);

            return $this->redirectToRoute('app_resto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('resto/edit.html.twig', [
            'restaurant' => $restaurant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_resto_delete', methods: ['POST'])]
    public function delete(Request $request, Restaurant $restaurant, RestaurantRepository $restaurantRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$restaurant->getId(), $request->request->get('_token'))) {
            $restaurantRepository->remove($restaurant, true);
        }

        return $this->redirectToRoute('app_resto_index', [], Response::HTTP_SEE_OTHER);
    }
}
