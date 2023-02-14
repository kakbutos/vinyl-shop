<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Models\TableField;
use Eshop\src\Service\MainService;
use Eshop\src\Service\AdminService;

class AdminController
{
	public function getAdmin(): string
	{
		$render = new Template('../src/Views');
		$tags = MainService::getTagsList();

		return $render->render('admin', [

		]);
	}

	public function getProductList()
	{
		$list = AdminService::getProductList();

		if ($_GET['table'] === 'product')
		{
			$data = json_encode($list, JSON_THROW_ON_ERROR);
		}

		return $data;
	}
}