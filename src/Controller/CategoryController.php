<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index(): Response
    {
        $articles = $this->getDoctrine()->getRepository
        (Product::class)->findAll();
        return $this->render('category/index.html.twig',
            ['category' => $articles,'articles' => $articles]);
    }

    /**
    * @Route("/category", name="category_fetch")
    */
    public function categoryFetch($category_id)
 {
    $articles = $this->getDoctrine()->getRepository
    (Product::class)->findAll();

    $repository = $this->getDoctrine()->getRepository(Product::class);
    $category = $repository->findBy(array('Category' => $category_id)); 
    return $this->render('category/index.html.twig',
            ['category' => $category , 'articles' => $articles]);
}
}

