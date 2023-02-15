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

	public static function addProductList(): void
	{
		$product = new Product(
			(int)$_POST['ID'],
			$_POST['NAME'],
			$_POST['ARTIST'],
			$_POST['RELEASE_DATE'],
			(float)$_POST['PRICE'],
			[],
			(int)$_POST['VINYL_STATUS_ID'],
			$_POST['COVER_STATUS'],
			$_POST['TRACKS'],
			(bool)$_POST['IS_ACTIVE'],
		);

		try
		{
			(new AdminRepository())->addProduct($product);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
}