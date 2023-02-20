<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Service\MainService;
use Eshop\src\Service\Pagination;

class MainController
{

	public function render_catalog($items, $tags, $pagination = null): string
	{
		$render = new Template('../src/Views');
		return $render->render('layout', [
			'header' => $render->render('/components/header', []),
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
		$paginationArray = $this->paginationForItems($countList);
		$items = MainService::getProductList(null, "", $paginationArray);

		return $this->render_catalog($items, $tags, $paginationArray['pagination']);
	}

	public function catalogByTag($tag): string
	{
		$countList = MainService::getCountList($tag);
		$tags = MainService::getTagsList();
		$paginationArray = $this->paginationForItems($countList);
		$items = MainService::getProductList($tag, "", $paginationArray);

		return $this->render_catalog($items, $tags, $paginationArray['pagination']);
	}

	public function catalogBySearch(): string
	{
		$search = $_GET['search-string'] ?? "";
		$countList = MainService::getCountList(null, $search);
		$tags = MainService::getTagsList();
		$paginationArray = $this->paginationForItems($countList);
		$items = MainService::getProductList(null, $search, $paginationArray);

		return $this->render_catalog($items, $tags, $paginationArray['pagination']);
	}

	public function paginationForItems($total): array
	{
		$page = $_GET['page'] ?? 1;
		$per_page = 2;
		$pagination = new Pagination((int)$page, $per_page, $total);
		$start = $pagination->get_start();

		return [
			'start' => $start,
			'per_page' => $per_page,
			'pagination' => $pagination
		];
	}
}