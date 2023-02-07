<?php

namespace Eshop\src\Models;

use Exception;

class Product
{
	private int $id;
	private string $name;
	private string $artist;
	private string $releaseDate;
	private string $price;

	/**
	 * @throws Exception
	 */
	public function __construct (int $id, string $name, string $artist, string $releaseDate, float $price)
	{
		$this->id = $id;
		$this->name = $name;
		$this->artist = $artist;
		$this->releaseDate = $releaseDate;
		$this->price = $price;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getArtist(): string
	{
		return $this->artist;
	}

	public function getReleaseDate(): string
	{
		return $this->releaseDate;
	}

	public function getPrice(): string
	{
		return $this->price;
	}
}