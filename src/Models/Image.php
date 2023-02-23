<?php

namespace Eshop\src\Models;

use Exception;

class Image
{
	private int $id;
	private string $path;
	private string $name;
	private bool $isMain;

	public function __construct (int $id, string $path, string $name, bool $isMain)
	{
		$this->id = $id;
		$this->path = $path;
		$this->name = $name;
		$this->isMain = $isMain;
	}

	public function getPath(): string
	{
		return $this->path;
	}

	public function IsMain(): bool
	{
		return $this->isMain;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getId(): int
	{
		return $this->id;
	}
}