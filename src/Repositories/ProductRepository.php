<?php
namespace Eshop\src\Repositories;

use Eshop\Core\DB\Connection;
use Eshop\src\Models\Product;
use Exception;

class ProductRepository
{
	/**
	 * @throws Exception
	 */
	public function getList()
	{
		$connection = Connection::getInstance()->getConnection();

		$productQuery = mysqli_query($connection, "
			SELECT p.ID,p.NAME, p.PRICE, p.RELEASE_DATE, a.NAME as ARTIST  FROM product p
			INNER JOIN artist a on p.ARTIST_ID = a.ID
");
		if (!$productQuery)
		{
			throw new Exception(mysqli_error($connection));
		}

		$product = [];
		while ($row = mysqli_fetch_assoc($productQuery))
		{
			$product[] = new Product(
				$row['ID'],
				$row['NAME'],
				$row['ARTIST'],
				$row['RELEASE_DATE'],
				$row['PRICE']
			);
		}

		return $product;
	}
}