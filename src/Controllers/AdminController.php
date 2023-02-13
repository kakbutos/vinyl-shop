<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Service\MainService;

class AdminController
{
	public function getAdmin(): string
	{
		$render = new Template('../src/Views');
		$tags = MainService::getTagsList();

		return $render->render('admin', [
			// 'content' => $render->render(),
		]);
	}

	public function getAction()
	{
		$render = new Template('../src/Views');
		$tags = MainService::getTagsList();
		$data = json_encode(['heh', 'hoh', 'hah'], JSON_THROW_ON_ERROR);

		return $data;
	}
}