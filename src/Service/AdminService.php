<?php

namespace Eshop\src\Service;

use Eshop\src\Models\Product;
use Eshop\src\Models\Tag;
use Eshop\src\Repositories\AdminRepository;
use Exception;
use Eshop\src\Service\Validator;

class AdminService
{
	public static function getProductList():array
	{
		return (new AdminRepository())->getProdsByAdmin();
	}

	public static function getTagList():array
	{
		return (new AdminRepository())->getTagsByAdmin();
	}

	public static function getOrderList(): array
	{
		return (new AdminRepository())->getOrdersByAdmin();
	}

	public static function addNewProduct(): array
	{
		return (new AdminRepository())->addEmptyProduct();
	}

	public static function addNewTag(): array
	{
		return (new AdminRepository())->addEmptyTag();
	}


	public static function deleteProduct(int $id): bool
	{
		return (new AdminRepository())->deleteProduct($id);
	}
	public static function deleteTag(int $id): bool
	{
		return (new AdminRepository())->deleteTag($id);
	}

	public static function updateTag($tag): array
	{
		$validate = new Validator();

		$validate->set('ID', $tag['ID'])->isRequired()->isNumber()
			->set('Название', $tag['NAME'])->isRequired()->maxLength(200);

		if($validate->validate())
		{
			$tagObj = new Tag((int)$tag['ID'], $tag['NAME']);

			(new AdminRepository())->updateTag($tagObj);
		}
		else
		{
			$errors = $validate->getErrors();
			$stringErrors = [];
			foreach ($errors as $error)
			{
				$stringErrors[] = $error;
			}
			return $stringErrors;
		}

		return [];
	}

	public static function updateProduct($product):array
	{
		$validate = new Validator();

		$validate->set('ID', $product['ID'])->isRequired()->isNumber()
			->set('Название', $product['NAME'])->isRequired()->maxLength(200)
			->set('Исполнитель', $product['ARTIST'])->isRequired()->maxLength(200)
			->set('Дата релиза', $product['RELEASE_DATE'])->isRequired()->isNumber()
			->set('Цена', $product['PRICE'])->isNumber()
			->set('Качество винила', $product['VINIL_STATUS'])->isRequired()->maxLength(4)
			->set('Качество конверта', $product['COVER_STATUS'])->isRequired()->maxLength(50);
		// ->set('Треки', $product['TRACKS'])->isRequired()->maxLength(1000);

		if ($validate->validate())
		{
			$productObj = new Product((int)$product['ID'], $product['NAME'], $product['ARTIST'],
				$product['RELEASE_DATE'],
				(float)$product['PRICE'], [], $product['VINIL_STATUS'], $product['COVER_STATUS'],
				$product['TRACKS'], (bool)$product['IS_ACTIVE']);

			(new AdminRepository())->updateProduct($productObj);
		}
		else
		{
			$errors = $validate->getErrors();
			$stringErrors = [];
			foreach ($errors as $error)
			{
				$stringErrors[] = $error;
			}
			return $stringErrors;
		}

		return [];
	}
}