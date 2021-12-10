<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Entity\Panier;
use Symfony\Component\HttpFoundation\Request;


class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(Request $request): Response
    {
        if(empty($panier)){
            $panierData = [];
        $userID = $this->get('security.token_storage')->getToken()->getUser();
        $session = $request->getSession();
        $panier = $session->get('panier',[]);
        $panUser = $this->getDoctrine()
          ->getRepository(Panier::class)
          ->find($userID->getId());
        $CartCurrentUser = $panUser->getCart();
        if($CartCurrentUser != null){
        $session->set('panier',$CartCurrentUser);
    }
    }
        //dd($CartCurrentUser);
      /* if(empty($panier)){
       
       foreach ($panUser as $pan)
       {
       $panierData[] = [
      'id'=> $p->getIdProduct(),
      'quantity'=> $p->getQuantity(),
      'image' => $p->getImage(),
      'price' => $p->getPrice(),
      'name'  => $p->getName()
       ];
        
        $session->set('panier',$panierData);
    }*/
        

        $articles = $this->getDoctrine()->getRepository
        (Product::class)->findAll();
        return $this->render('index/index.html.twig',
            ['articles' => $articles]);
    }
}
