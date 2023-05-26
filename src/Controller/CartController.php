<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CartController extends AbstractController
{
    private $cart;
    private $entityManager;


    public function __construct(Cart $cart, EntityManagerInterface $entityManager)
    {
        $this->cart = $cart;
        $this->entityManager = $entityManager;
    }
    #[Route('/mon-panier', name: 'app_cart')]
    
    public function index(Cart $cart): Response
    {
    
        $cartComplete = [];

        foreach($cart->get() as $id => $quantity){
            $cartComplete[]=[
                'product'=> $this -> entityManager->getRepository(Product::class)->findOneById($id),
                'quantity'=>$quantity
            ];
        }

        return $this->render('cart/index.html.twig', [
            'app_cart'=>$cartComplete
        ]);
    }

    #[Route('/cart/add/{id}', name: 'app_add_to_cart')]



    public function add(Cart $cart, $id): Response

    {
       $cart->add($id);
       
       return $this->redirectToRoute('app_cart');
    }
            
       #[Route('/cart/remove', name: 'app_remove_my_cart')]



       public function remove(Cart $cart): Response
   
       {
          $cart->remove();
          
          return $this->redirectToRoute('app_products');
               
       
       }
    
}
