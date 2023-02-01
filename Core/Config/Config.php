<?php

namespace Eshop\Config;

use Exception;

class Config {
	function option(string $name, $defaultValue = null)
	{
		static $config = null;

		if ($config === null)
		{
			$masterConfig = require_once __DIR__ . '/config.php';
			if (file_exists(__DIR__ . '/config.local.php'))
			{
				$localConfig = require __DIR__ . '/config.local.php';
			}
			else
			{
				$localConfig = [];
			}
			$config = array_merge($masterConfig, $localConfig);
		}

		if (array_key_exists($name, $config))
		{
			return($config[$name]);
		}

		if ($defaultValue === null)
		{
			return $defaultValue;
		}
		throw new Exception("Config option {$name} not found");
	}
}