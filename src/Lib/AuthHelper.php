<?php

namespace Eshop\src\Lib;

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
}