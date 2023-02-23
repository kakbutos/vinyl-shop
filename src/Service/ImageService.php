<?php

namespace Eshop\src\Service;

use Eshop\src\Repositories\ImageRepository;

class ImageService
{
	public static function getImageList($id): array
	{
		return (new ImageRepository())->getImageList($id);
	}

	public static function addImage(int $id, $file): bool
	{
		$name = $file['name'];
		$guid = bin2hex(openssl_random_pseudo_bytes(16));
		$dir = ROOT . "/public/assets/img/{$guid}/";
		// var_dump($dir);
		if (!mkdir($dir) && !is_dir($dir))
		{
			// throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
			return false;
		}

		$pathFile = $dir . $name;
		if (move_uploaded_file($file['tmp_name'], $pathFile))
		{
			return (new ImageRepository())->addImage($id, $guid, $name);
		}

		return false;
	}

	public static function deleteImage($imageId): int
	{
		$select = (new ImageRepository())->deleteImage($imageId);
		if(empty($select))
		{
			return 0;
		}

		$productId = $select['productId'];
		$name = $select['name'];
		$dir = ROOT . "/public/assets/img/{$select['path']}/";

		$test = unlink($dir . $name);
		if (!$test)
		{
			return 0;
		}

		$test = rmdir($dir);
		if(!$test)
		{
			return 0;
		}

		return $productId;
	}
}