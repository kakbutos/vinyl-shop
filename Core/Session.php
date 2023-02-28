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

	public function get(): ?array
	{
		return $_SESSION ?? null;
	}

	public function getValue(string $name)
	{
		return $_SESSION[$name] ?? null;
	}

	public function setValue(string $key, $value): void
	{
		$_SESSION[$key] = $value;
	}

	public function unset(string $name): void
	{
		if (isset($_SESSION[$name]))
		{
			unset($_SESSION[$name]);
		}
	}
}