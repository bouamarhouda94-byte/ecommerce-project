<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('pages/index.html.twig');
    }

    #[Route('/login', name: 'login')]
    public function login(): Response
    {
        return $this->render('pages/login.html.twig');
    }

    #[Route('/profile', name: 'profile')]
    public function profile(): Response
    {
        return $this->render('pages/profile.html.twig');
    }

    #[Route('/product', name: 'product_details')]
    public function product(): Response
    {
        return $this->render('pages/product_details.html.twig');
    }

    #[Route('/categories', name: 'categories')]
    public function categories(): Response
    {
        return $this->render('pages/browse_categories.html.twig');
    }

    #[Route('/cart', name: 'cart')]
    public function cart(): Response
    {
        return $this->render('pages/cart.html.twig');
    }

    #[Route('/products', name: 'products_by_category')]
    public function products(): Response
    {
        return $this->render('pages/products_by_category.html.twig');
    }
}