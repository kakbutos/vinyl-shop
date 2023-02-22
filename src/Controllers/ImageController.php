<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Service\ImageService;

class ImageController
{
	public function getImage(string $id): string
	{
		$render = new Template('../src/Views');
		$imageList = ImageService::getImageList($id);

		return $render->render('image', [
			'imageList' => $imageList,
		]);
	}
}