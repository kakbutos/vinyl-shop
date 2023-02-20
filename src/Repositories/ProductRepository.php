<?php

namespace Eshop\src\Repositories;

use Eshop\Core\DB\Connection;
use Eshop\src\Models\Image;
use Eshop\src\Models\Product;
use Exception;

class ProductRepository
{
	/**
	 * @throws Exception
	 */
	public function getList(int $tag = null, string $search = "", array $page = [])
	{
		$connection = Connection::getInstance()->getConnection();

		$tag = mysqli_escape_string($connection, $tag);
		$search = mysqli_escape_string($connection, $search);
		$start = $page ? mysqli_escape_string($connection, $page['start']) : '';
		$per_page = $page ? mysqli_escape_string($connection, $page['per_page']) : '';

		$makeWhereQuery = 'where i.IS_MAIN = 1';
		$makeWhereQuery = $tag ? $makeWhereQuery . " and  pt.TAG_ID = $tag" : $makeWhereQuery;
		$joinTagTable = $tag ? 'JOIN product_tag pt on p.ID = pt.PRODUCT_ID' : '';
		$makeWhereQuery = $search ? $makeWhereQuery . " and p.NAME LIKE '%{$search}%'" : $makeWhereQuery;
		$limitPagination = $page ? "LIMIT {$start}, {$per_page}" : '';

		$Query = mysqli_query($connection, "
			SELECT p.ID,p.NAME, p.PRICE, p.RELEASE_DATE, i.PATH, a.NAME as ARTIST  FROM product p
			JOIN artist a on p.ARTIST_ID = a.ID
			JOIN product_image pi on p.ID = pi.PRODUCT_ID
			JOIN image i on i.ID = pi.IMAGE_ID
			{$joinTagTable}
			{$makeWhereQuery}
			{$limitPagination}
		");

		if (!$Query)
		{
			throw new Exception(mysqli_error($connection));
		}

		$productsList = [];
		while ($row = mysqli_fetch_assoc($Query))
		{
			$image[0] = new Image(
				$row['ID'],
				$row['PATH'],
				true
			);

			$productsList[] = new Product(
				$row['ID'],
				$row['NAME'],
				$row['ARTIST'],
				$row['RELEASE_DATE'],
				(float)$row['PRICE'],
				$image
			);
		}
		return $productsList;
	}

	public function getProductById(int $id){

		$connection = Connection::getInstance()->getConnection();

		$Query = mysqli_query($connection, "
			SELECT i.ID, i.PATH, i.IS_MAIN FROM image i
			join product_image pi on i.ID = pi.IMAGE_ID
			where pi.PRODUCT_ID = $id;
		");

		if (!$Query)
		{
			throw new Exception(mysqli_error($connection));
		}

		$imageList = [];
		while ($row = mysqli_fetch_assoc($Query))
		{
			$imageList[] = new Image(
				$row['ID'],
				$row['PATH'],
				$row['IS_MAIN'] === '1'
			);
		}

		$Query = mysqli_query($connection, "
			SELECT p.ID,p.NAME, p.PRICE, p.RELEASE_DATE, a.NAME as ARTIST, s.ID as VINYL_STATUS, 
			       s.NAME as VINYL_NAME, s.DESCRIPTION as VINYL_DESCRIPTION, p.COVER_STATUS, p.TRACKS  
			FROM product p
			JOIN artist a on p.ARTIST_ID = a.ID
			JOIN status s on p.VINYL_STATUS_ID = s.ID
			WHERE p.ID = $id;
		");

		if (!$Query)
		{
			throw new Exception(mysqli_error($connection));
		}

		$product = null;
		while ($row = mysqli_fetch_assoc($Query))
		{
			$product = new Product(
				$row['ID'],
				$row['NAME'],
				$row['ARTIST'],
				$row['RELEASE_DATE'],
				$row['PRICE'],
				$imageList,
				$row['VINYL_STATUS'],
				$row['COVER_STATUS'],
				explode(';', $row['TRACKS']),
				false,
				$row['VINYL_NAME'],
				$row['VINYL_DESCRIPTION']
			);
		}
		return $product;
	}

	public function getCountList(int $tag = null, string $search = "")
	{
		$connection = Connection::getInstance()->getConnection();

		$tag = mysqli_escape_string($connection, $tag);
		$search = mysqli_escape_string($connection, $search);

		$joinTagTable = $tag ? 'JOIN product_tag pt on p.ID = pt.PRODUCT_ID' : '';
		$makeWhereQuery = $tag ? "pt.TAG_ID = $tag" : '';
		$makeWhereQuery = $search ? $makeWhereQuery . "p.NAME LIKE '%{$search}%'" : $makeWhereQuery;
		$makeWhereQuery = ($makeWhereQuery !== '') ? "where " . $makeWhereQuery : '';

		$Query = mysqli_query($connection, "
			SELECT COUNT(p.ID) as `COUNT` FROM product p
			{$joinTagTable}
			{$makeWhereQuery}
		");

		if (!$Query)
		{
			throw new Exception(mysqli_error($connection));
		}

		$count = mysqli_fetch_assoc($Query);

		return $count['COUNT'];
	}
}