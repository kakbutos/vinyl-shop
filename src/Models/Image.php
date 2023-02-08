<?php

namespace Eshop\src\Models;

use Exception;

class Image
{
	private int $productId;
	private string $path;
	private bool $isMain;

	public function __construct (int $productId, string $path, bool $isMain)
	{
		$this->productId = $productId;
		$this->path = $path;
		$this->isMain = $isMain;
	}

	public function getProductId(): int
	{
		return $this->productId;
	}

	public function getPath(): string
	{
		return $this->path;
	}

	public function IsMain(): bool
	{
		return $this->isMain;
	}

}