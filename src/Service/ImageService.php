<?php

namespace Eshop\src\Service;

use Eshop\src\Repositories\ImageRepository;

class ImageService
{
	public static function getProductList(): array
	{
		return (new ImageRepository())->getList();
	}
}