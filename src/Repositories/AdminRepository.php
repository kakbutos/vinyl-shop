<?php

namespace Eshop\src\Repositories;

use Eshop\Core\DB\Connection;
use Eshop\src\Models\Image;
use Eshop\src\Models\Product;
use Eshop\src\Models\TableField;
use Exception;

class AdminRepository
{
	public function getProdsByAdmin():array
	{
		$List = [];
		$connection = Connection::getInstance()->getConnection();
		$Query = mysqli_query($connection, "
			SELECT p.ID,p.NAME, p.PRICE, p.RELEASE_DATE, a.NAME as ARTIST, p.COVER_STATUS, p.TRACKS, p.IS_ACTIVE, p.VINYL_STATUS_ID
			FROM product p
	        JOIN artist a on p.ARTIST_ID = a.ID
		");
		if (!$Query)
		{
			throw new Exception(mysqli_error($connection));
		}

		while ($row = mysqli_fetch_assoc($Query))
		{

			$List[] = [
				(int)$row['ID'],
				$row['NAME'],
				$row['ARTIST'],
				$row['RELEASE_DATE'],
				(float)$row['PRICE'],
				$row['VINYL_STATUS_ID'],
				$row['COVER_STATUS'],
				$row['TRACKS'],
				(bool)['IS_ACTIVE']
			];
		}

		$tableField = [
			new TableField('ID', 'id', 'ID'),
			new TableField('Название', 'text', 'NAME'),
			new TableField('Исполнитель', 'text', 'ARTIST'),
			new TableField('Дата релиза', 'number', 'RELEASE_DATE'),
			new TableField('Цена', 'number', 'PRICE'),
			new TableField('Качество винила', 'text', 'VINIL_STATUS'),
			new TableField('Качество конверта', 'text', 'COVER_STATUS'),
			new TableField('Треки', 'text', 'TRACKS'),
			new TableField('Активен', 'bool', 'IS_ACTIVE'),
		];

		return [(array)$tableField, (array)$List];
	}

	public function addProduct():void
	{

	}

	public function getTagsByAdmin():array
	{
		$connection = Connection::getInstance()->getConnection();
		$Query = mysqli_query($connection, "
			SELECT t.ID, t.NAME
			FROM tag t
		");
		if (!$Query)
		{
			throw new Exception(mysqli_error($connection));
		}
		$List = [];
		while ($row = mysqli_fetch_assoc($Query))
		{

			$List[] = [
				(int)$row['ID'],
				$row['NAME']
			];
		}

		$tableField = [
			new TableField('ID', 'id', 'ID'),
			new TableField('Название', 'text', 'NAME')
		];

		return [(array)$tableField, (array)$List];
	}
}