<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Service\UserService;
use Eshop\src\Lib\AuthHelper;

class userAdminController
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
}