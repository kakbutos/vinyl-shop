<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Repositories\TagRepository;
use Exception;

class MainController
{
	/**
	 * @throws Exception
	 */
	public function mainAction(): void
	{
		$tags = (new TagRepository())->getList();

		$render = new Template('../src/Views');
		print $render->render('layout', [
			'header' => $render->render('/components/header', []),
			'sidebar' => $render->render('/components/sidebar', ['tags' => $tags]),
			'pagination' => $render->render('/components/pagination', []),
			'mainPage' => $render->render('/public/main', []),
			]);
	}
}