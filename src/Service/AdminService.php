<?php

namespace Eshop\src\Service;

use Eshop\src\Repositories\AdminRepository;

class AdminService
{
	public static function getProductList():array
	{
		return (new AdminRepository())->getProdsByAdmin();
	}

	public static function getTagList():array
	{
		return (new AdminRepository())->getTagsByAdmin();
	}
}