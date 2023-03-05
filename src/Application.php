<?php

namespace Eshop;

use Eshop\Core\Config\Config;
use Eshop\Core\DB\Migrator;
use Eshop\core\Routing\Router;
use Eshop\Core\Session;
use Eshop\Core\Template\Template;

class Application
{
	public function run(): void
	{
		if (Config::option('MIGRATOR_MODE') === 'dev')
		{
			Migrator::migrate();
		}

		new Session();

		$route = Router::findRoute($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

		if ($route)
		{
			$action = $route->action;
			$variables = $route->getVariables();
			echo $action(...$variables);
		}
		else
		{
			$render = new Template('../src/Views');

			echo $render->render('errorPage', [
				'responseCode' => 404,
			]);
		}
	}
}
