<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Lib\AuthHelper;
use Eshop\src\Service\ImageService;

class ImageController
{
	public function getImage(int $id): string
	{
		if (!UserAdminController::isAuthorized())
		{
			header("Location: " . AuthHelper::getUrl() . "/login");
		}
		$info = '';
		if (isset($_GET['info']))
		{
			$info = $_GET['info'];
		}

		$render = new Template('../src/Views');
		$imageList = ImageService::getImageList($id);

		return $render->render('admin/image', [
			'info' => $render->render('/components/adminInfo', ['info' => $info]),
			'imageList' => $imageList,
			'productId' => $id,
		]);
	}

	public function addImage(int $productId)
	{
		if (!UserAdminController::isAuthorized())
		{
			header("Location: " . AuthHelper::getUrl() . "/login");
		}

		$info = '';
		if(!empty($_FILES['file']))
		{
			$file = $_FILES['file'];
			$info = ImageService::addImage($productId, $file);
		}

		header("Location: " . AuthHelper::getUrl() . "/admin/image/{$productId}/?info={$info}");
	}

	public function deleteImage(int $imageId): void
	{
		if (!UserAdminController::isAuthorized())
		{
			header("Location: " . AuthHelper::getUrl() . "/login");
		}

		$info = ImageService::deleteImage($imageId);
		if($info['productId'] === 0)
		{
			header("Location: " . AuthHelper::getUrl() . "/admin");
		}
		header("Location: " . AuthHelper::getUrl() . "/admin/image/{$info['productId']}/?info={$info['info']}");
	}

	public function getIsMainImage(int $imageId): void
	{
		if (!UserAdminController::isAuthorized())
		{
			header("Location: " . AuthHelper::getUrl() . "/login");
		}

		$info = ImageService::setIsMainImage($imageId);

		header("Location: " . AuthHelper::getUrl() . "/admin/image/{$info['productId']}/?info={$info['info']}");
	}

}