<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Models\Product;
use Eshop\src\Service\MainService;
use Eshop\src\Service\AdminService;
use Eshop\src\Service\UserService;
use Eshop\src\Lib\AuthHelper;

class AdminController
{
	public function auth()
	{
		session_start();

		$email = htmlspecialchars($_POST['email']);
		$password = htmlspecialchars($_POST['password']);
		$admin = UserService::getUser($email)[0];

		$isCorrectPassword = password_verify($password, $admin->password);

		if ($isCorrectPassword)
		{
			$_SESSION['USER'] = $admin->id;
			header("Location: " . AuthHelper::getUrl() . "/admin");
		}
		else
		{
			header("Location: " . AuthHelper::getUrl() . "/login");
		}
	}

	public function logout(): void
	{
		session_start();
		session_destroy();
		header("Location: " . AuthHelper::getUrl() . "/login");
	}

	public function login()
	{
		$render = new Template('../src/Views');
		return $render->render('login', []);
	}

	public function getAdmin(): string
	{
		session_start();
		$render = new Template('../src/Views');

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

		if ($_GET['table'] === 'tag')
		{
			return json_encode(AdminService::addNewTag(), JSON_THROW_ON_ERROR);
		}
		return 0;
	}



	/**
	 * @throws \Exception
	 */
	public function setItem()
	{
		$item = $_POST['obj'];
		$namedItem = [];
		for ($i = 0, $iMax = count($item); $i< $iMax; $i++){
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
				'IS_ACTIVE' => $namedItem['IS_ACTIVE']
			];
			$errors = AdminService::updateProduct($product);
		}

		return json_encode($errors , JSON_THROW_ON_ERROR);
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