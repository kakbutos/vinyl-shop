<?php

namespace Eshop\src\Repositories;

use Eshop\Core\DB\Connection;
use Eshop\src\Models\Image;
use Eshop\src\Models\Product;
use Eshop\src\Models\TableField;
use Exception;

class AdminRepository
{
	public function getProdsByAdmin(): array
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
				(bool)['IS_ACTIVE'],
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

	public function addEmptyProduct(): array
	{
		$connection = Connection::getInstance()->getConnection();

		$queryProduct = "INSERT INTO product
			(NAME, ARTIST_ID, RELEASE_DATE, PRICE, VINYL_STATUS_ID, COVER_STATUS, 
			 TRACKS, IS_ACTIVE)
					VALUES ('Новый продукт',  1, '2000', 0,'VG+','M','Нет',1
			   );";

		$Query = mysqli_query($connection, $queryProduct);
		$id = mysqli_insert_id($connection);
		return [$id, 'Новый продукт', 1, '2000', 0, 'VG+', 'M', 'Нет', 1];
	}

	public function addEmptyTag(): array
	{
		$connection = Connection::getInstance()->getConnection();

		$queryTag = "INSERT INTO tag
		(NAME) 
				VALUES ('Новый тег');
		";

		$Query = mysqli_query($connection, $queryTag);
		$id = mysqli_insert_id($connection);
		return [$id, 'Новый тег'];
	}

	public function updateProduct($product): bool
	{
		$connection = Connection::getInstance()->getConnection();

		$productId = $product->getId();
		$productName = mysqli_real_escape_string($connection, $product->getName());
		$productArtist = mysqli_real_escape_string($connection, $product->getArtist());
		$productReleaseDate = $product->getReleaseDate();
		$productPrice = $product->getPrice();
		$productVinylStatus = mysqli_real_escape_string($connection, $product->getVinylStatus());
		$productCoverStatus = mysqli_real_escape_string($connection, $product->getCoverStatus());
		$productTracks = mysqli_real_escape_string($connection, implode(';', $product->getTracks()));
		$productIsActive = $product->getIsActive();

		$queryArtist = "SELECT a.ID FROM artist a
			INNER JOIN product p on a.ID = p.ARTIST_ID
			WHERE a.NAME = '$productArtist';
		";
		$query = mysqli_query($connection, $queryArtist);

		$artistId = null;
		while ($row = mysqli_fetch_assoc($query))
		{
			$artistId = $row['ID'];
		}

		mysqli_begin_transaction($connection);
		if ($artistId === null)
		{
			$queryArtist = "INSERT INTO artist (NAME) 
			VALUES ('$productArtist');
            ";

			mysqli_query($connection, $queryArtist);
			$artistId = mysqli_insert_id($connection);
		}
		$queryProduct = "UPDATE product
			SET NAME = '$productName', ARTIST_ID = {$artistId}, RELEASE_DATE = '$productReleaseDate',
			    PRICE = {$productPrice}, VINYL_STATUS_ID = '$productVinylStatus', 
			    COVER_STATUS = '$productCoverStatus', TRACKS = '$productTracks', IS_ACTIVE = {$productIsActive}
			WHERE ID = {$productId}
			;";
		$test = mysqli_query($connection, $queryProduct);
		mysqli_commit($connection);
		return $test;
	}

	public function updateTag($tag): void
	{
		$connection = Connection::getInstance()->getConnection();

		$tagId = $tag->getId();
		$tagName = $tag->getTitle();

		mysqli_begin_transaction($connection);
		$queryTag = "UPDATE tag SET NAME = '$tagName' WHERE ID = {$tagId}";
		$test = mysqli_query($connection, $queryTag);
		mysqli_commit($connection);
	}

	public function deleteProduct($id): bool
	{
		$connection = Connection::getInstance()->getConnection();

		$deleteQuery = mysqli_query($connection, "
			DELETE FROM product
			WHERE ID = {$id};
		");
		return $deleteQuery;
	}

	public function deleteTag($id): bool
	{
		$connection = Connection::getInstance()->getConnection();

		$deleteQuery = mysqli_query($connection, "
		DELETE FROM tag
		WHERE ID = {$id};
		");
		return $deleteQuery;
	}

	public function getTagsByAdmin(): array
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
				$row['NAME'],
			];
		}

		$tableField = [
			new TableField('ID', 'id', 'ID'),
			new TableField('Название', 'text', 'NAME'),
		];

		return [(array)$tableField, (array)$List];
	}

	public function getOrdersByAdmin(): array
	{
		$connection = Connection::getInstance()->getConnection();
		$Query = mysqli_query($connection, "
			SELECT ID, DATE, CUSTOMER_NAME, CUSTOMER_EMAIL, CUSTOMER_PHONE, COMMENT, STATUS
			FROM `order`
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
				$row['DATE'],
				$row['CUSTOMER_NAME'],
				$row['CUSTOMER_EMAIL'],
				$row['CUSTOMER_PHONE'],
				$row['COMMENT'],
				$row['STATUS'],
			];
		}
		$tableField = [
			new TableField('ID', 'id', 'ID'),
			new TableField('Дата', 'text', 'DATE'),
			new TableField('Имя покупателя', 'text', 'CUSTOMER_NAME'),
			new TableField('Почта покупателя', 'text', 'CUSTOMER_EMAIL'),
			new TableField('Телефон покупателя', 'text', 'CUSTOMER_PHONE'),
			new TableField('Комментарий', 'text', 'COMMENT'),
			new TableField('Статус заказа', 'text', 'STATUS'),
		];
		return [(array)$tableField, (array)$List];
	}
}