<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Lib\AuthHelper;
use Eshop\src\Service\ImageService;

class ImageController
{
	public function getImage(int $id): string
	{
		if (!userAdminController::isAuthorized()) header("Location: " . AuthHelper::getUrl() . "/login");

		$render = new Template('../src/Views');
		$imageList = ImageService::getImageList($id);

		return $render->render('image', [
			'imageList' => $imageList,
			'productId' => $id,
		]);
	}

	public function addImage(int $id): void
	{
		if(!empty($_FILES['file']))
		{
			$file = $_FILES['file'];
			$test = ImageService::addImage($id, $file);
		}

		header("Location: " . AuthHelper::getUrl() . "/admin/image/{$id}/");
	}

	public function deleteImage(int $imageId): void
	{
		$productId = ImageService::deleteImage($imageId);
		if($productId === 0)
		{
			header("Location: " . AuthHelper::getUrl() . "/admin");
		}
		header("Location: " . AuthHelper::getUrl() . "/admin/image/{$productId}/");
	}

	public function getIsMainImage(int $imageId): void
	{
		$productId = ImageService::setIsMainImage($imageId);

		header("Location: " . AuthHelper::getUrl() . "/admin/image/{$productId}/");
	}

}