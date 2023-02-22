<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;

class ImageController
{
	public function getImage(string $id): string
	{
		$render = new Template('../src/Views');


		return $render->render('image', [
			'images' => $images,
		]);
	}
}