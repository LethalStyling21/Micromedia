<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index($id): Response
    {
        $product = $this->getDoctrine()
        ->getRepository(Product::class)
        ->find($id);
        $article = [
            'id'=> $id,
            'image' => $product->getImage(),
            'price' => $product->getPrice(),
            'name'  => $product->getProductName()
             ];
        return $this->render('product/index.html.twig',['article' =>$article]);
    }
}
