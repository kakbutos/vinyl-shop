<?php

use Eshop\Core\Template\Template;

require_once '../boot.php';

try
{
	$app = new Eshop\Application();
	$app->run();
}

catch (Exception $e)
{
	ob_clean();
	$render = new Template('../src/Views');

	echo $render->render('errorPage', [
		'responseCode' => 500,
	]);
}
