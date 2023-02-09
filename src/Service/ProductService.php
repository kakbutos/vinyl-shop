<?php

namespace Eshop\src\Service;

use Eshop\src\Models\Product;
use Eshop\src\Models\Tag;
use Eshop\src\Repositories\ProductRepository;
use Eshop\src\Repositories\TagRepository;

class ProductService
{
	public static function getProductById($id): Product
	{
		return (new ProductRepository())->getProductById($id);
	}

	// Получить жанры одного товара в виде строки
	public static function getTagById($id): string
	{
		$tagString = [];
		$tags = (new TagRepository())->getOneById($id);
		foreach ($tags as $tag)
		{
			$tagString[] = $tag->getTitle();
		}
		return implode(', ', $tagString);
	}
}