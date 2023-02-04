<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;

class MainController
{
	public function mainAction(): void
	{
		$render = new Template('/src/Views');
		$render->render('layout', [
			'1' => 'asd',
			]);
	}
}