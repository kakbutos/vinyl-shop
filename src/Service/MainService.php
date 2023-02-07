<?php

namespace Eshop\src\Service;

use Eshop\src\Repositories\ImageRepository;
use Eshop\src\Repositories\ProductRepository;
use Eshop\src\Repositories\TagRepository;

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

	public static function getTagsList(): array
	{
		return (new TagRepository())->getList();
	}
}