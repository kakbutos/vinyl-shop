<?php

namespace Eshop;

use Eshop\Core\Config\Config;
use Eshop\Core\DB\Migrator;
use Eshop\core\Routing\Router;

class Application
{
	public function run(): void
	{
		if (Config::option('MIGRATOR_MODE') === 'dev')
		{
			Migrator::migrate();
		}
		$route = Router::findRoute($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

		if ($route)
		{
			$action = $route->action;
			$variables = $route->getVariables();
			echo $action(...$variables);
		}
		else
		{
			http_response_code(404);
			echo 'Page not found';
			exit;
		}
	}
}
