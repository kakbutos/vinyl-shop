<?php

namespace Eshop\src\Models;

use Exception;

class Image
{
	private int $productId;
	private string $path;
	private string $isMain;

	public function __construct (int $productId, string $path, string $isMain)
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

	public function getIsMain(): string
	{
		return $this->isMain;
	}

}