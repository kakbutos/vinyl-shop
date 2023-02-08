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
	public function getList(int $tag = null, string $search = "", int $page = null)
	{
		$connection = Connection::getInstance()->getConnection();
		//todo сократить общие части
		//просто каталог
		if ($tag === null && $search === ""){
			$Query = mysqli_query($connection, "
				SELECT p.ID,p.NAME, p.PRICE, p.RELEASE_DATE, i.PATH, a.NAME as ARTIST  FROM product p
				JOIN artist a on p.ARTIST_ID = a.ID
				JOIN product_image pi on p.ID = pi.PRODUCT_ID
				JOIN image i on i.ID = pi.IMAGE_ID
				where i.IS_MAIN = 1
			");
		}
		//поиск по каталогу
		elseif ($search != null && $search != ""){
			$Query = mysqli_query($connection, "
				SELECT p.ID,p.NAME, p.PRICE, p.RELEASE_DATE, i.PATH, a.NAME as ARTIST  FROM product p
				JOIN artist a on p.ARTIST_ID = a.ID
				JOIN product_image pi on p.ID = pi.PRODUCT_ID
				JOIN image i on i.ID = pi.IMAGE_ID
				where i.IS_MAIN = 1 
				  and p.NAME LIKE '%$search%'
			");
		}
		//каталог по тегу
		else{
			$Query = mysqli_query($connection, "
				SELECT p.ID,p.NAME, p.PRICE, p.RELEASE_DATE, i.PATH, a.NAME as ARTIST  FROM product p
				JOIN artist a on p.ARTIST_ID = a.ID
				JOIN product_image pi on p.ID = pi.PRODUCT_ID
				JOIN image i on i.ID = pi.IMAGE_ID
				JOIN product_tag pt on p.ID = pt.PRODUCT_ID                                                                       
				where i.IS_MAIN = 1 and pt.TAG_ID = $tag
			");
		}


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
				$row['PRICE'],
				$image
			);
		}
		return $productsList;
	}

	public function getListByTag(int $id){

	}

	public function getProductById(int $id){

		$connection = Connection::getInstance()->getConnection();

		$Query = mysqli_query($connection, "
			SELECT i.ID, i.PATH, i.IS_MAIN FROM image i
			join product_image pi on i.ID = pi.IMAGE_ID
			where pi.PRODUCT_ID = $id
		");

		if (!$Query)
		{
			throw new Exception(mysqli_error($connection));
		}

		$imageList = [];
		while ($row = mysqli_fetch_assoc($Query)){
			$imageList[] = new Image(
				$row['ID'],
				$row['PATH'],
				$row['IS_MAIN'] === '1'
			);
		}

		$Query = mysqli_query($connection, "
			SELECT p.ID,p.NAME, p.PRICE, p.RELEASE_DATE, a.NAME as ARTIST  FROM product p
			JOIN artist a on p.ARTIST_ID = a.ID
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
				$imageList
			);
		}
		return $product;
	}

}