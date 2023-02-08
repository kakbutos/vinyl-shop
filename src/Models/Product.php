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
	private array $imageList;
	/**
	 * @throws Exception
	 */
	public function __construct (int $id, string $name, string $artist, string $releaseDate, float $price, array $imageList = [])
	{
		$this->id = $id;
		$this->name = $name;
		$this->artist = $artist;
		$this->releaseDate = $releaseDate;
		$this->price = $price;
		$this->imageList = $imageList;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function setId($id): void{
		$this->id=$id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setName($name): void{
		$this->name=$name;
	}

	public function getArtist(): string
	{
		return $this->artist;
	}

	public function setArtist($artist): void{
		$this->artist=$artist;
	}

	public function getReleaseDate(): string
	{
		return $this->releaseDate;
	}

	public function setReleaseDate($releaseDate): void
	{
		$this->releaseDate = $releaseDate;
	}

	public function getPrice(): string
	{
		return $this->price;
	}

	public function setPrice($price): void{
		$this->price = $price;
	}

	public function getImageList():array{
		return $this->imageList;
	}

	public function setImageList($imageList):void{
		$this->imageList = $imageList;
	}
}