<?php

namespace Eshop\src\Service;

use Eshop\src\Models\Product;
use Eshop\src\Repositories\AdminRepository;
use Exception;

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

	public static function addEmptyProduct(): void
	{
		try
		{
			(new AdminRepository())->addEmptyProduct();
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
}