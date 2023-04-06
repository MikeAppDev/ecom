<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(SessionInterface $session): Response
    {

        $cart = $session->get('cart', []);


        return $this->render('cart/index.html.twig', [
            'cart' => $cart
        ]);
    }

    #[Route('/add-to-cart/{platId}', name: 'app_add_cart')]
    public function addToCart(Request $request, int $platId): Response
    {
        $session = $request->getSession();
        //$quantity = $request->get('quantity');

        //Pour vider la session en cas d'erreur
        //$session->set('cart', []);
        
        $cart = $session->get('cart', []);
        //dd($cart);
        if (!isset($cart[$platId])) {
            // Si le produit n'existe pas encore dans le panier
            $cart[$platId] = [
                'name' => $request->get('name'),
                'price' => $request->get('price'),
                'quantity' => $request->get('quantity')
            ];
        } else {
            // Si le produit existe déjà dans le panier, augmenter la quantité
            $cart[$platId]['quantity']++;
        }

        //$cart[$platId] = $quantity;

        $session->set('cart', $cart);
        // dd($session->get('cart'));
        $previousUrl = $request->headers->get('referer');
        return $this->redirect($previousUrl);

        
    }

}
