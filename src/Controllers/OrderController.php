<?php

namespace Eshop\src\Controllers;

use Eshop\Core\Template\Template;

class OrderController
{
	public function orderAction(string $productId): void
	{
		$product =
		$render = new Template('../src/Views');
		print $render->render('layout', [
			'header' => $render->render('/components/header', []),
			'sidebar' => $render->render('/components/sidebar', []),
			'pagination' => $render->render('/components/pagination', []),
			'mainPage' => $render->render('/public/order', ['product' => $product]),
		]);
	}

}