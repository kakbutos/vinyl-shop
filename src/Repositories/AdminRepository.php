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
		$connection = Connection::getInstance()->getConnection();
		$Query = mysqli_query($connection, "
			SELECT * FROM product
		");
		if (!$Query)
		{
			throw new Exception(mysqli_error($connection));
		}
		$productsList = [];
		while ($row = mysqli_fetch_assoc($Query))
		{
			$image[0] = new Image(
				'',
				'',
				false
			);

			$productsList[] = new Product(
				$row['ID'],
				$row['NAME'],
				$row['ARTIST'],
				$row['RELEASE_DATE'],
				(float)$row['PRICE'],
				[$image],
				$row['VINYL_STATUS_ID'],
				$row['COVER_STATUS'],
				$row['TRACKS'],
				$row['IS_ACTIVE'],

			);
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

		return [$productsList, $tableField];
	}
}