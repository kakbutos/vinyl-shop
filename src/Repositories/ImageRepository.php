<?php

namespace Eshop\src\Repositories;

use Eshop\Core\DB\Connection;
use Eshop\src\Models\Image;
use MongoDB\Driver\Query;

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

	public function addImage($id, $guid, $name): string
	{
		$connection = Connection::getInstance()->getConnection();

		$queryImage = "INSERT INTO image (PATH, NAME, IS_MAIN)
			VALUES ('$guid', '$name', false);
		";

		mysqli_begin_transaction($connection);

		$query = mysqli_query($connection, $queryImage);
		if ($query)
		{
			$imageId = mysqli_insert_id($connection);

			$query = mysqli_query($connection, "
			INSERT INTO product_image (PRODUCT_ID, IMAGE_ID)
			VALUES ('$id', '$imageId');
		");

			if ($query === false)
			{
				mysqli_rollback($connection);
				return 'addError';
			}

			mysqli_commit($connection);
			return 'addOk';
		}

		return 'addError';
	}

	public function deleteImage($imageId): array
	{
		$connection = Connection::getInstance()->getConnection();

		$selectQuery = mysqli_query($connection, "
		SELECT i.NAME, i.PATH, pi.PRODUCT_ID FROM image i
		INNER JOIN product_image pi on i.ID = pi.IMAGE_ID
		WHERE i.ID = {$imageId};
		");

		$select = [];

		while ($row = mysqli_fetch_assoc($selectQuery))
		{
			$select = array(
				'name' => $row['NAME'],
				'path' => $row['PATH'],
				'productId' => $row['PRODUCT_ID'],
				);
		}

		$deleteProductImageQuery = mysqli_query($connection, "
			DELETE FROM product_image
			WHERE IMAGE_ID = {$imageId};
		");


		$deleteImageQuery = mysqli_query($connection, "
			DELETE FROM image
			WHERE ID = {$imageId};
		");
		if(!$deleteImageQuery && !$deleteProductImageQuery)
		{
			return [];
		}

		return $select;
	}

	public function setIsMainImage($imageId): array
	{
		$select = ['productId' => 0, 'info' => 'isMainError'];
		$connection = Connection::getInstance()->getConnection();

		$selectQuery = mysqli_query($connection, "
		SELECT PRODUCT_ID FROM product_image
		WHERE IMAGE_ID = {$imageId};
		");
		$productId = 0;

		while ($row = mysqli_fetch_assoc($selectQuery))
		{
			(int)$productId = $row['PRODUCT_ID'];
		}
		$select['productId'] = $productId;

		$updateQuery = "
		UPDATE image
		SET IS_MAIN = FALSE
		WHERE ID IN
		(SELECT IMAGE_ID FROM product_image
		WHERE PRODUCT_ID = {$productId})
		";

		$updateNewQuery = "
		UPDATE image
		SET IS_MAIN = TRUE
		WHERE ID = {$imageId};
		";

		mysqli_begin_transaction($connection);
		$query = mysqli_query($connection, $updateQuery);
		var_dump($query);
		if ($query)
		{
			$query = mysqli_query($connection, $updateNewQuery);
		}

		if ($query === false)
		{
			mysqli_rollback($connection);
			return $select;
		}
		mysqli_commit($connection);
		$select['info'] = 'isMainOk';
		return $select;
	}
}
