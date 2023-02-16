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

	public function getList()
	{
		$data = [];

		if ($_GET['table'] === 'product')
		{
			$list = AdminService::getProductList();
			$data = json_encode($list, JSON_THROW_ON_ERROR);
		}

		if ($_GET['table'] === 'tag')
		{
			$list = AdminService::getTagList();
			$data = json_encode($list, JSON_THROW_ON_ERROR);
		}

		return $data;
	}

	public function newItem()
	{

		if ($_GET['table'] === 'product')
		{
			$temp = AdminService::addNewProduct();
			return json_encode($temp , JSON_THROW_ON_ERROR);
		}
		return 0;
	}

	public function setItem()
	{

	}
}