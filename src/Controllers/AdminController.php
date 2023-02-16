<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
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

		if ($_GET['table'] === 'newObj')
		{
			AdminService::addEmptyProduct();
		}

		return $data;
	}

	public function setItem()
	{

	}
}