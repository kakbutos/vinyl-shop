<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;

class OrderController
{
	public function orderAction(): void
	{
		$render = new Template('../src/Views');
		print $render->render('layout', [
			'header' => $render->render('/components/header', []),
			'sidebar' => $render->render('/components/sidebar', []),
			'pagination' => $render->render('/components/pagination', []),
			'mainPage' => $render->render('/public/main', []),
		]);
	}

}