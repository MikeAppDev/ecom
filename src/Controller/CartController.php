<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Entity\Product;
use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(SessionInterface $session, PlatRepository $repository): Response
    {

        $cart = $session->get('cart', []);
        $products = [];

        foreach ($cart as $id => $product) {
            # stock de la quantité
            $quantity = $product['quantity'];

            // on récupère le produit depuis la base de données
            $product = $repository->find($id);

            // on lui affecte la quantité
            $product->setQuantity($quantity);

            $products[] = $product;
        }

        $total = array_reduce($products, function ($total, Plat $product){
            return $total + $product->getQuantity() * $product->getPrice();
        }, 0);

        return $this->render('cart/index.html.twig', [
            'cart' => $products,
            'total' => $total
        ]);
    }

    #[Route('/add-to-cart/{platId}', name: 'app_add_cart')]
    public function addToCart(Request $request, int $platId): Response
    {
        $session = $request->getSession();
        $quantity = $request->get('quantity');

        //Pour vider la session en cas d'erreur
        //$session->set('cart', []);
        
        $cart = $session->get('cart', []);
        //dd($cart);

        $cart[$platId] = [
            'quantity' => $request->get('quantity')
        ];

        $session->set('cart', $cart);

        // dd($session->get('cart'));
        $previousUrl = $request->headers->get('referer');
        return $this->redirect($previousUrl);

        
    }

    #[Route('/cart/clear', name: 'app_cart_clear')]
    public function clear(SessionInterface $session): Response
    {
        $session->clear();
        return $this->redirectToRoute('app_cart');
    }

}
