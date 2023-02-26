<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Models\Product;
use Eshop\src\Lib\AuthHelper;
use Eshop\src\Service\MainService;
use Eshop\src\Service\AdminService;

class AdminController
{
	public function getAdmin(): string
	{
		if (!userAdminController::isAuthorized())
		{
			header("Location: " . AuthHelper::getUrl() . "/login");
		}
		$render = new Template('../src/Views');
		return $render->render('admin', []);
	}

	public function getList()
	{
		if (!userAdminController::isAuthorized())
		{
			return '';
		}

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

	public function addItem()
	{
		if (!userAdminController::isAuthorized())
		{
			header("Location: " . AuthHelper::getUrl() . "/login");
		}

		if ($_GET['table'] === 'product')
		{
			return json_encode(AdminService::addNewProduct() , JSON_THROW_ON_ERROR);
		}

		if ($_GET['table'] === 'tag')
		{
			return json_encode(AdminService::addNewTag(), JSON_THROW_ON_ERROR);
		}

		if ($_GET['table'] === 'order')
		{
			return json_encode(AdminService::addNewOrder(), JSON_THROW_ON_ERROR);
		}

		return 0;
	}



	/**
	 * @throws \Exception
	 */
	public function updateItem()
	{
		if (!userAdminController::isAuthorized())
		{
			header("Location: " . AuthHelper::getUrl() . "/login");
		}

		$item = $_POST['obj'];
		$namedItem = [];

		for ($i = 0, $iMax = count($item); $i< $iMax; $i++)
		{
			$namedItem[$item[$i]['field']] = $item[$i]['value'];
		}

		if ($_POST['table'] === 'product'){

			$product = [
				'ID' => $namedItem['ID'],
				'NAME' => $namedItem['NAME'],
				'ARTIST' => $namedItem['ARTIST'],
				'RELEASE_DATE' => $namedItem['RELEASE_DATE'],
				'PRICE' => $namedItem['PRICE'],
				'IMAGE_LIST' => [],//imageList
				'VINIL_STATUS' => $namedItem['VINIL_STATUS'],
				'COVER_STATUS' => $namedItem['COVER_STATUS'],
				'TRACKS' => [$namedItem['TRACKS']],
				'IS_ACTIVE' => $namedItem['IS_ACTIVE'],
			];
			$errors = AdminService::updateProduct($product);
		}

		if ($_POST['table'] ==='tag'){
			$tag = [
				'ID' => $namedItem['ID'],
				'NAME' => $namedItem['NAME'],
			];
			$errors = AdminService::updateTag($tag);
		}

		if ($_POST['table'] ==='update'){
			$update = [
				'ID' => $namedItem['ID'],
				'DATE' => $namedItem['DATE'],
				'CUSTOMER_NAME' => $namedItem['CUSTOMER_NAME'],
				'CUSTOMER_EMAIL' => $namedItem['CUSTOMER_EMAIL'],
				'CUSTOMER_PHONE' => $namedItem['CUSTOMER_PHONE'],
				'COMMENT' => $namedItem['COMMENT'],
				'STATUS' => $namedItem['STATUS'],
			];
			$errors = AdminService::updateOrder($update);
		}

		return json_encode($errors , JSON_THROW_ON_ERROR);
	}

	public function deleteItem(){
		if (!userAdminController::isAuthorized())
		{
			header("Location: " . AuthHelper::getUrl() . "/login");
		}

		$table = $_POST['table'];
		$id = (int)$_POST['id'];
		if($table === 'product'){
			return json_encode(AdminService::deleteProduct($id), JSON_THROW_ON_ERROR);
		}

		if ($table === 'tag'){
			return json_encode(AdminService::deleteTag($id), JSON_THROW_ON_ERROR);
		}

		if ($table === 'order'){
			return json_encode(AdminService::deleteOrder($id), JSON_THROW_ON_ERROR);
		}

		return 0;
	}

	public function getSelectFieldData(){
		if (!userAdminController::isAuthorized()) header("Location: " . AuthHelper::getUrl() . "/login");

		$field = $_GET['field'];
		if ($field === 'VINIL_STATUS'){
			return json_encode(AdminService::getVinilStatuses(), JSON_THROW_ON_ERROR);
		}

	}
}