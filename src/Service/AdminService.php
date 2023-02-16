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

	public static function getOrderList(): array
	{
		return (new AdminRepository())->getOrdersByAdmin();
	}

	public static function addNewProduct(): array
	{
		return (new AdminRepository())->addEmptyProduct();
	}

	public static function updateProduct(
		$id, $Name, $Artist,
		$ReleaseDate, $Price, $images, $vinylStatus,
		$coverStatus, $tracks, $isActive
	)
	{
		$product = new Product(
			$id,  $Name,  $Artist, $ReleaseDate,
			$Price, $images, $vinylStatus,
			$coverStatus, $tracks, $isActive
		);

		(new AdminRepository())->updateProduct($product);
	}
}