<?php

namespace Eshop\src\Repositories;

use Eshop\Core\DB\Connection;
use Eshop\src\Models\Image;

class ImageRepository
{
	public function getImageList($id): array
	{
		$connection = Connection::getInstance()->getConnection();
		$Query = mysqli_query($connection, "
			SELECT i.ID, i.PATH, i.NAME, i.IS_MAIN FROM image i
			join product_image pi on i.ID = pi.IMAGE_ID
			where pi.PRODUCT_ID = $id;
		");

		$imageList = [];
		while ($row = mysqli_fetch_assoc($Query))
		{
			$imageList[] = new Image(
				$row['ID'],
				$row['PATH'],
				$row['NAME'],
				(bool)$row['IS_MAIN'],
			);
		}
		return $imageList;
	}
}
