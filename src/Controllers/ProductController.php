<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Models\Cart;
use Eshop\src\Service\MainService;
use Eshop\src\Service\ProductService;

class ProductController
{
	public function detail(string $id): string
	{
		$quantityProductsInCart = (new Cart())->getTotalQuantity();
		$tags = MainService::getTagsList();
		$product = ProductService::getProductById($id);
		$productTags = ProductService::getTagById($id);

		$render = new Template('../src/Views');
		return $render->render('layout', [
			'header' => $render->render('/components/header', ['quantity' => $quantityProductsInCart]),
			'sidebar' => $render->render('/components/sidebar', ['tags' => $tags]),
			'content' => $render->render('/public/product',['product' => $product, 'productTags'=>$productTags]),
		]);
	}
}