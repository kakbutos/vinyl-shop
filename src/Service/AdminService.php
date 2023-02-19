<?php

namespace Eshop\src\Service;

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

	public static function deleteProduct(int $id): bool{
		return (new AdminRepository())->deleteProduct($id);
	}

	public static function updateProduct($product):bool
	{
		return (new AdminRepository())->updateProduct($product);
	}

}