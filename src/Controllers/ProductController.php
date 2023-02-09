<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Service\MainService;
use Eshop\src\Service\ProductService;

class ProductController
{
	public function detail(string $id): string
	{
		$tags = MainService::getTagsList();
		$product = ProductService::getProductById($id);
		$productTags = ProductService::getTagById($id);

		$render = new Template('../src/Views');
		return $render->render('layout', [
			'header' => $render->render('/components/header', []),
			'sidebar' => $render->render('/components/sidebar', ['tags' => $tags]),
			'content' => $render->render('/public/product',['product' => $product, 'productTags'=>$productTags]),
		]);
	}
}