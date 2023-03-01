<?php

namespace Eshop\src\Lib;

use Eshop\src\Service\Pagination;

class PaginationHelper
{
	public static function paginationForItems($total): array
	{
		$page = $_GET['page'] ?? 1;
		$per_page = 4;
		$pagination = new Pagination((int)$page, $per_page, $total);
		$start = $pagination->get_start();

		return [
			'start' => $start,
			'per_page' => $per_page,
			'pagination' => $pagination
		];
	}
}