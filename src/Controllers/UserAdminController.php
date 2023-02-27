<?php

namespace Eshop\Controllers;

use Eshop\Core\Session;
use Eshop\Core\Template\Template;
use Eshop\src\Service\UserService;
use Eshop\src\Lib\AuthHelper;

class UserAdminController
{
	public function auth()
	{
		new Session();

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
		new Session();
		$_SESSION = [];
		session_destroy();
		header("Location: " . AuthHelper::getUrl() . "/login");
	}

	public function login()
	{
		$render = new Template('../src/Views');
		return $render->render('admin/login', []);
	}

	public static function isAuthorized(): bool
	{
		new Session();
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

	public static function checkCsrfToken(): bool
	{
		new Session();

		$csrf = null;
		foreach (getallheaders() as $name => $value) {
			if ($name === 'X-CSRF-TOKEN') {
				$csrf = $value;
			}
		}

		if ($_SESSION['csrf_token'] !== $csrf)
		{
			return false;
		}

		return true;
	}
}