<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use App\Entity\Panier;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\ProductRepository;



class CartController extends AbstractController
{
/**
 * @Route("/cart", name="cart")
 */
public function index(SessionInterface $session, ProductRepository $productRep)
 {
 $panier = $session->get('panier',[]);
 $items = [];
 $total = 0;
foreach ($panier as $id => $quantity)
 {

    $product = $productRep->find($id);
    $items[] = [
       'product' => $product,
       'quantity' => $quantity
    ];
    $itemsPanier[$id] = $quantity;
    $total += $product->getPrice() * $quantity;
 
 }

return $this->render('cart/index.html.twig', compact("items","total"));
 }
/**
 * @Route("/add", name="app_add")
 */
public function add($id, Request $request)
 {
    
 $session = $request->getSession();
 $panier = $session->get('panier',[]);
 
if(!empty($panier[$id]))
 $panier[$id]++;
else
 $panier[$id]=1;
 $session->set('panier',$panier);
return $this->redirectToRoute('cart');
 }

 /**
 * @Route("/remove", name="app_remove")
 */

 public function remove($id, Request $request , ProductRepository $productRep)
 {
    
   $session = $request->getSession();
   $panier = $session->get('panier');
   if (array_key_exists($id,$panier))
   {
   unset($panier[$id]);
   }
 
   foreach ($panier as $id => $quantity)
 {

    $product = $productRep->find($id);
    $items[] = [
       'product' => $product,
       'quantity' => $quantity
    ];
    $itemsPanier[$id] = $quantity;
        //dd($product);
 
 }

  return $this->redirectToRoute('cart');

 }
}