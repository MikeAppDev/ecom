<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class StripeController extends AbstractController
{
    #[Route('/checkout', name: 'app_checkout')]
    public function index(): Response
    {
        return $this->render('stripe/index.html.twig', [
           
        ]);
    }

    #[Route('/stripe', name: 'app_stripe')]
    public function paymentAction(Request $request)
{
    // Récupérer le montant du paiement
    //$amount = $request->request->get('amount');

    // Configurer Stripe avec vos clés d'API
    Stripe::setApiKey($this->getParameter('stripe.secret_key'));

    // Créer un objet de paiement avec Stripe
    $charge = PaymentIntent::create(array(
        'amount' => 1200,
        'currency' => 'eur',
        'description' => 'Paiement de '. 1200 .' euros'
    ));
    $output = [
        'clientSecret' => $charge->client_secret,
    ];

    // Si le paiement a réussi, vous pouvez enregistrer les informations du paiement et rediriger l'utilisateur vers une page de confirmation.
    // Sinon, vous devez afficher un message d'erreur à l'utilisateur.

    // Exemple de redirection vers une page de confirmation
    $json = new JsonResponse($output);
    return $json;
}
}
