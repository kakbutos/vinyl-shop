<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Repositories\ImageRepository;
use Eshop\src\Repositories\ProductRepository;
use Eshop\src\Service\MainService;

class MainController
{

	//todo сократить в одну функцию
	public function catalog(): string
	{
		$items = MainService::getProductList();
		$tags = MainService::getTagsList();

		$render = new Template('../src/Views');
		return $render->render('layout', [
			'header' => $render->render('/components/header', []),
			'sidebar' => $render->render('/components/sidebar', ['tags' => $tags]),
			'content' => $render->render('/public/main', [
				'pagination' => $render->render('/components/pagination', []),
				'items' => $items
			])
		]);
	}

	public function catalogByTag($tag): string
	{
		$items = MainService::getProductList($tag);

		$tags = MainService::getTagsList();

		$render = new Template('../src/Views');
		return $render->render('layout', [
			'header' => $render->render('/components/header', []),
			'sidebar' => $render->render('/components/sidebar', ['tags' => $tags]),
			'content' => $render->render('/public/main', [
				'pagination' => $render->render('/components/pagination', []),
				'items' => $items,
			]),
		]);

	}

	public function catalogBySearch(): string{
		{
			$search = $_GET['search-string'] ?? "";
			$items = MainService::getProductList(null, $search);
			$tags = MainService::getTagsList();

			$render = new Template('../src/Views');
			return $render->render('layout', [
				'header' => $render->render('/components/header', []),
				'sidebar' => $render->render('/components/sidebar', ['tags' => $tags]),
				'content' => $render->render('/public/main', [
					'pagination' => $render->render('/components/pagination', []),
					'items' => $items,
				]),
			]);
		}
	}
}