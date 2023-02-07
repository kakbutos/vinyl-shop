<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Repositories\ImageRepository;
use Eshop\src\Repositories\ProductRepository;
use Eshop\src\Service\MainService;

class MainController
{
	public function mainAction(): void
	{
		$items = MainService::getProductList();
		$images = MainService::getImageList();

		$render = new Template('../src/Views');
		print $render->render('layout', [
			'header' => $render->render('/components/header', []),
			'sidebar' => $render->render('/components/sidebar', []),
			'pagination' => $render->render('/components/pagination', []),
			'mainPage' => $render->render('/public/main', ['items' => $items, 'images' => $images]),
			]);
	}
}