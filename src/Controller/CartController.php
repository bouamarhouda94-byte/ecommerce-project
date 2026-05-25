<?php

namespace App\Controller;

use App\Cart\CartHandler;
use App\Cart\CartInterface;
use App\Cart\SessionCart;
use App\Entity\CartItem;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    public function __construct(
        private CartHandler $cartHandler,

        #[Autowire(service: SessionCart::class)]
        private CartInterface $strategy,
    ) {
    }

    private string $cartId = 'mon_panier';

    #[Route('/cart', name: 'cart_show')]
    public function show(): Response
    {
        $cart = $this->strategy->getCart($this->cartId);

        return $this->render('cart/show.html.twig', [
            'cart' => $cart,
        ]);
    }

    #[Route('/cart/add/{id}', name: 'cart_add', methods: ['POST'])]
    public function add(Product $product): Response
    {
        $item = new CartItem();
        $item->setProduct($product);
        $item->setPrice($product->getPrice()); // ✅ هنا التصحيح
        $item->setQuantity(1);

        $cart = $this->strategy->getCart($this->cartId);
        $this->cartHandler->handle($item, $cart, $this->strategy);

        $this->addFlash('success', 'Product added to cart!');

        return $this->redirectToRoute('cart_show');
    }

    #[Route('/cart/remove/{id}', name: 'cart_remove', methods: ['POST'])]
    public function remove(Product $product): Response
    {
        $item = new CartItem();
        $item->setProduct($product);
        $item->setPrice($product->getPrice()); // ✅ هنا التصحيح
        $item->setQuantity(1);

        $cart = $this->strategy->getCart($this->cartId);
        $this->cartHandler->removeItem($item, $cart, $this->strategy);

        $this->addFlash('success', 'Product removed from cart!');

        return $this->redirectToRoute('cart_show');
    }

    #[Route('/cart/clear', name: 'cart_clear', methods: ['POST'])]
    public function clear(): Response
    {
        $this->cartHandler->clear($this->cartId, $this->strategy);

        $this->addFlash('success', 'Cart cleared!');

        return $this->redirectToRoute('cart_show');
    }
}