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
		$csrf_token = htmlspecialchars($_POST['csrf_token']);
		$admin = UserService::getUser($email)[0];

		if (!isset($admin))
		{
			header("Location: " . AuthHelper::getUrl() . "/login");
		}

		$isCorrectPassword = password_verify($password, $admin->password);

		if ($isCorrectPassword && ($_SESSION['csrf_token'] === $csrf_token))
		{
			$_SESSION['USER_EMAIL'] = $admin->email;
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
		$_SESSION = [];
		session_destroy();
		header("Location: " . AuthHelper::getUrl() . "/login");
	}

	public function login()
	{
		$render = new Template('../src/Views');
		return $render->render('login', []);
	}

	public static function isAuthorized(): bool
	{
		session_start();
		$email = $_SESSION['USER_EMAIL'];
		if (!isset($email))
		{
			return false;
		}

		$admin = UserService::getUser($email)[0];
		if (!isset($admin))
		{
			return false;
		}

		if ($admin->email === $email)
		{
			return true;
		}

		return false;
	}
}