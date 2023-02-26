<?php

namespace Eshop\src\Service;

use Eshop\src\Repositories\ImageRepository;

class ImageService
{
	public static function getImageList($id): array
	{
		return (new ImageRepository())->getImageList($id);
	}

	public static function addImage(int $id, $file): string
	{
		$formatImage = array('png', 'jpg', 'gif', 'jpeg');
		$name = $file['name'];

		$array = explode('.', strtolower($name));

		if(!in_array(array_pop($array), $formatImage, true))
		{
			return 'addError';
		}
		$guid = bin2hex(openssl_random_pseudo_bytes(16));
		$dir = ROOT . "/public/assets/img/{$guid}/";
		// var_dump($dir);
		if (!mkdir($dir) && !is_dir($dir))
		{
			// throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
			return 'addError';
		}

		$pathFile = $dir . $name;
		if (move_uploaded_file($file['tmp_name'], $pathFile))
		{
			return (new ImageRepository())->addImage($id, $guid, $name);
		}

		return 'addError';
	}

	public static function deleteImage($imageId): array
	{
		$info = ['productId' => 0, 'info' => 'deleteError'];
		$select = (new ImageRepository())->deleteImage($imageId);
		if(empty($select))
		{
			return $info;
		}

		$info['productId'] = $select['productId'];
		$name = $select['name'];
		$dir = ROOT . "/public/assets/img/{$select['path']}/";

		$test = unlink($dir . $name);
		if (!$test)
		{
			return $info;
		}

		$test = rmdir($dir);
		if(!$test)
		{
			return $info;
		}
		$info['info'] = 'deleteOk';
		return $info;
	}

	public static function setIsMainImage($imageId): array
	{
		$info = (new ImageRepository())->setIsMainImage($imageId);

		return $info;
	}
}