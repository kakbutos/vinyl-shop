<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Models\Cart;
use Eshop\src\Models\Product;
use Eshop\src\Repositories\ProductRepository;
use Eshop\src\Service\MainService;
use Exception;

class CartController
{
	/**
	 * @throws Exception
	 */
	public function addToCart(string $productId): bool
	{
		$id = (int)$productId;
		$product = (new ProductRepository())->getProductById($id);
		if ($product === null)
		{
			return false;
		}

		$cart = new Cart();
		$cart->addProduct($product);

		return true;
	}

	/**
	 * @throws Exception
	 */
	public function reduceProductQuantity(string $productId): bool
	{
		$id = (int)$productId;
		$product = (new ProductRepository())->getProductById($id);
		if ($product === null)
		{
			return false;
		}

		$cart = new Cart();
		$reduce = $cart->reduceProductQuantity($product);
		if (!$reduce)
		{
			return false;
		}

		return true;
	}

	/**
	 * @throws Exception
	 */
	public function getCart(): string
	{
		$quantityProductsInCart = (new Cart())->getTotalQuantity();
		$tags = MainService::getTagsList();
		$render = new Template('../src/Views');

		if ($quantityProductsInCart > 0)
		{
			$cart = new Cart();
			$products = $cart->getCart();

			return $render->render('layout', [
				'header' => $render->render('/components/header', ['quantity' => $quantityProductsInCart]),
				'sidebar' => $render->render('/components/sidebar', ['tags' => $tags]),
				'content' => $render->render('/public/cart', ['products' => $products]),
			]);
		}

		return $render->render('layout', [
			'header' => $render->render('/components/header', ['quantity' => $quantityProductsInCart]),
			'sidebar' => $render->render('/components/sidebar', ['tags' => $tags]),
			'content' => 'Корзина пуста',
		]);
	}

	/**
	 * @throws Exception
	 */
	public function deleteProductFromCart($productId): void
	{
		$cart = new Cart();
		$cart->deleteProduct($productId);

		$referrer = $_SERVER['HTTP_REFERER'];
		header("Location: $referrer");
	}
}