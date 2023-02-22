<?php

namespace Eshop\src\Service;

use Eshop\src\Repositories\ImageRepository;

class ImageService
{
	public static function getImageList($id): array
	{
		return (new ImageRepository())->getImageList($id);
	}
}