<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Service\MainService;
use Eshop\src\Service\AdminService;
use Eshop\src\Lib\AuthHelper;

class AdminController
{
	public function getAdmin(): string
	{
		session_start();
		$render = new Template('../src/Views');
		// AdminService::updateProduct(
		// 	1,'Тестовый продукт','AC/DC',
		// 	'2000',999, [],'VG+','Статус',
		// 	explode(';','Песня 1;Песня 2'), 1
		// );

		if (!$_SESSION['USER'])
		{
			header("Location: " . AuthHelper::getUrl() . "/login");
		}

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

		if ($_GET['table'] === 'order')
		{
			$list = AdminService::getOrderList();
			$data = json_encode($list, JSON_THROW_ON_ERROR);
		}

		return $data;
	}

	public function newItem()
	{

		if ($_GET['table'] === 'product')
		{
			return json_encode(AdminService::addNewProduct() , JSON_THROW_ON_ERROR);
		}
		return 0;
	}

	public function setItem()
	{

	}

	public function deleteItem(){
		$table = $_POST['table'];
		$id = (int)$_POST['id'];
		if($table === 'product'){
			$teml = 0;
			return json_encode(AdminService::deleteProduct($id), JSON_THROW_ON_ERROR);
		}
		return 0;
	}
}