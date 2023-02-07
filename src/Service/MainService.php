<?php
namespace Eshop\src\Service;
use Eshop\src\Repositories\ImageRepository;
use Eshop\src\Repositories\ProductRepository;
class MainService
{
	public static function getProductList(): array
	{
		return (new ProductRepository())->getList();
	}


	public static function getImageList(): array
	{
		return (new ImageRepository())->getList();
	}
}