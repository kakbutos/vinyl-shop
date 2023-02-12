<?php

namespace Eshop\src\Models;

use Exception;

class Product
{
	private int $id;
	private string $name;
	private string $artist;
	private string $releaseDate;
	private float $price;
	private array $imageList;
	private ?string $vinylStatus;
	private ?string $coverStatus;
	private ?array $tracks;
	private  ?string $vinylStatusName;
	private ?string $vinylStatusDesk;
	/**
	 * @throws Exception
	 */
	public function __construct (int $id, string $name, string $artist, string $releaseDate,
		 float $price, array $imageList = [], ?string $vinylStatus = null,
		?string $coverStatus = null, ?array $tracks = null, ?string $vinylStatusName = null, ?string $vinylStatusDesk = null)
	{
		$this->id = $id;
		$this->name = $name;
		$this->artist = $artist;
		$this->releaseDate = $releaseDate;
		$this->price = $price;
		$this->imageList = $imageList;
		$this->vinylStatus = $vinylStatus;
		$this->coverStatus = $coverStatus;
		$this->tracks = $tracks;
		$this->vinylStatusName = $vinylStatusName;
		$this->vinylStatusDesk = $vinylStatusDesk;
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

	public function getPrice(): float
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

	public function getVinylStatus(): string
	{
		return $this->vinylStatus;
	}

	public function setVinylStatus(string $vinylStatus): void
	{
		$this->vinylStatus = $vinylStatus;
	}

	public function getCoverStatus(): string
	{
		return $this->coverStatus;
	}

	public function setCoverStatus(string $coverStatus): void
	{
		$this->coverStatus = $coverStatus;
	}

	public function getTracks(): array
	{
		return $this->tracks;
	}

	public function setTracks(array $tracks): void
	{
		$this->tracks = $tracks;
	}

	public function getVinylStatusName(): ?string
	{
		return $this->vinylStatusName;
	}

	public function getVinylStatusDesk(): ?string
	{
		return $this->vinylStatusDesk;
	}


}