<?php

namespace Eshop\src\Service;

use Eshop\src\Models\Product;
use Eshop\src\Repositories\ProductRepository;

class ProductService
{
	public static function getProductById($id): Product
	{
		return (new ProductRepository())->getProductById($id);
	}
}