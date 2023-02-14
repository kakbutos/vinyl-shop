<?php

namespace Eshop\src\Repositories;

use Eshop\Core\DB\Connection;
use Eshop\src\Models\Image;
use Eshop\src\Models\Product;
use Exception;

class AdminRepository
{
	public function getProdsByAdmin()
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
				$image,
				$row['VINYL_STATUS_ID'],
				$row['COVER_STATUS'],
				$row['TRACKS'],
			);
		}
		return $productsList;
	}
}