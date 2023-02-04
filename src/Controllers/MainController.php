<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;

class MainController
{
	public function mainAction()
	{
		$render = new Template('src/Views/');
		$render->render('layout');
	}
}