<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Lib\AuthHelper;
use Eshop\src\Service\ImageService;

class ImageController
{
	public function getImage(string $id): string
	{
		if (!userAdminController::isAuthorized()) header("Location: " . AuthHelper::getUrl() . "/login");

		session_start();
		$render = new Template('../src/Views');
		$imageList = ImageService::getImageList($id);

		return $render->render('image', [
			'imageList' => $imageList,
			'productId' => $id,
		]);
	}

	public function getImageFile(string $id): string
	{
		$render = new Template('../src/Views');
		if(!empty($_FILES['file']))
		{
			$file = $_FILES['file'];
			$test = ImageService::addImageFile($id, $file);
			// var_dump($test);
		}
		var_dump('heh');
		header("Location: " . AuthHelper::getUrl() . "/admin/image/{$id}/");
	}
}