<?php

namespace Eshop\Core;

class Session
{
	public function __construct()
	{
		if (!isset($_SESSION))
		{
			session_start();
		}
	}

	public function get()
	{
		return $_SESSION ?? null;
	}

	public function getValue(string $name)
	{
		return $_SESSION[$name] ?? null;
	}

	public function setValue(string $name, string $key, $value): void
	{
		$_SESSION[$name][$key] = $value;
	}
}