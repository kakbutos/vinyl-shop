<?php

namespace Eshop\src\Service;

use Eshop\src\Models\Product;
use Eshop\src\Models\Tag;
use Eshop\src\Repositories\AdminRepository;
use Exception;
use Eshop\src\Service\Validator;
use Eshop\src\Repositories\OrderItemRepository;

class OrderItemService
{
	public static function getOrderItemList(int $id):array
	{
		return (new OrderItemRepository())->getOrderItems($id);
	}

	public static function addOrderItemList(int $id): bool
	{
		return (new OrderItemRepository())->addEmptyOrderItem($id);
	}

	public static function deleteOrderItemList(int $id): bool
	{
		return (new OrderItemRepository())->deleteEmptyOrderItem($id);
	}
}