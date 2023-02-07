<?php
namespace Eshop\src\Repositories;
use Eshop\Core\DB\Connection;
use Eshop\src\Models\Image;

class ImageRepository
{
	public function getList(): array
	{
		$connection = Connection::getInstance()->getConnection();

		$productQuery = mysqli_query($connection, "
			SELECT i.PATH, i.IS_MAIN, p.ID  FROM image i
			INNER JOIN  product_image pi on i.ID = pi.IMAGE_ID
			INNER JOIN product p on pi.PRODUCT_ID = p.ID 
			WHERE p.ID = pi.PRODUCT_ID AND i.IS_MAIN = TRUE
");
		if (!$productQuery)
		{
			throw new Exception(mysqli_error($connection));
		}

		$images = [];
		while ($row = mysqli_fetch_assoc($productQuery))
		{
			$images[] = new Image(
				$row['ID'],
				$row['PATH'],
				$row['IS_MAIN']
			);
		}

		return $images;
	}
}