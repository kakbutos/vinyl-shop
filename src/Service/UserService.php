<?php

namespace Eshop\src\Service;

use Eshop\src\Repositories\UserRepository;

class UserService
{
	public static function getUser($email): array
	{
		return (new UserRepository())->getUserByEmail($email);
	}
}