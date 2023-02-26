<?php

namespace Eshop\src\Lib;

use Eshop\Core\Session;

class AuthHelper
{
	public static function getPasswordHash(string $password): string
	{
		$passwordHash = password_hash($password, PASSWORD_DEFAULT);
		return $passwordHash;
	}

	public static function getUrl(): string
	{
		return ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
	}

	public static function generateFormCsrfToken()
	{
		new Session();
		return $_SESSION['csrf_token'] = substr(str_shuffle('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM'), 0,
			10);
	}
}