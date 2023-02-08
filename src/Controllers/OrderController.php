<?php

namespace Eshop\src\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Service\MainService;
use Eshop\src\Service\ProductService;

class OrderController
{
	public function order(string $id): string
	{
		$product = ProductService::getProductById($id);

		$render = new Template('../src/Views');
		return $render->render('layout', [
			'header' => $render->render('/components/header', []),
			'sidebar' => $render->render('/components/sidebar', []),
			'content' => $render->render('/public/order',[]),
		]);
	}

}