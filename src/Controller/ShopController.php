<?php

namespace App\Controller;

use App\Cart\CartInterface;
use App\Cart\SessionCart;
use App\DTO\CartItem;
use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class ShopController extends AbstractController
{
    #[Route('/categories', name: 'app_browse_categories')]
    public function browseCategories(CategoryRepository $repo): Response
    {
        return $this->render('main/browse_categories.html.twig', [
            'categories' => $repo->findAll(),
        ]);
    }

    #[Route('/category/{id}/products', name: 'app_products_by_category')]
    public function productsByCategory(Category $category): Response
    {
        return $this->render('main/products_by_category.html.twig', [
            'category' => $category,
            'products' => $category->getProducts(),
        ]);
    }

    #[Route('/product/{id}', name: 'app_product_details')]
    public function productDetails(Product $product): Response
    {
        return $this->render('main/product_details.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/cart/add/{id}', name: 'app_cart_add')]
    public function addToCart(
        Product $product,
        #[Autowire(service: SessionCart::class)] CartInterface $cartStrategy
    ): Response
    {
        $cart = $cartStrategy->getCart('main');

        $item = new CartItem();
        $item->setId($product->getId());
        $item->setProduct($product);
        $item->setPrice($product->getPrice());
        $item->setQuantity(1);

        $cartStrategy->add($item, $cart);

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart', name: 'app_cart')]
    public function cart(
        #[Autowire(service: SessionCart::class)] CartInterface $cartStrategy
    ): Response
    {
        $cart = $cartStrategy->getCart('main');

        return $this->render('main/cart.html.twig', [
            'cart' => $cart,
        ]);
    }
}