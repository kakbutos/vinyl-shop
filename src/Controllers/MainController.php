<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Lib\PaginationHelper;
use Eshop\src\Models\Cart;
use Eshop\src\Service\MainService;

class MainController
{

	public function renderCatalog($items, $tags, $pagination = null): string
	{
		$quantityProductsInCart = (new Cart())->getTotalQuantity();
		$render = new Template('../src/Views');
		return $render->render('layout', [
			'header' => $render->render('/components/header', ['quantity' => $quantityProductsInCart]),
			'sidebar' => $render->render('/components/sidebar', ['tags' => $tags]),
			'content' => $render->render('/public/main', [
				'pagination' => $render->render('/components/pagination', ['pagination' => $pagination]),
				'items' => $items,
			]),
		]);
	}

	public function catalog(): string
	{
		$countList = MainService::getCountList();
		$tags = MainService::getTagsList();
		$paginationArray = PaginationHelper::paginationForItems($countList);
		$items = MainService::getProductList(null, "", $paginationArray);

		return $this->renderCatalog($items, $tags, $paginationArray['pagination']);
	}

	public function catalogByTag($tag): string
	{
		$countList = MainService::getCountList($tag);
		$tags = MainService::getTagsList();
		$paginationArray = PaginationHelper::paginationForItems($countList);
		$items = MainService::getProductList($tag, "", $paginationArray);

		return $this->renderCatalog($items, $tags, $paginationArray['pagination']);
	}

	public function catalogBySearch(): string
	{
		$search = $_GET['search-string'] ?? "";
		$countList = MainService::getCountList(null, $search);
		$tags = MainService::getTagsList();
		$paginationArray = PaginationHelper::paginationForItems($countList);
		$items = MainService::getProductList(null, $search, $paginationArray);

		return $this->renderCatalog($items, $tags, $paginationArray['pagination']);
	}
}