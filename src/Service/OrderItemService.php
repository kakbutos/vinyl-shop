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

	public static function addOrderItemList(int $id): int
	{
		return (new OrderItemRepository())->addEmptyOrderItem($id);
	}

	public static function deleteOrderItemList(int $id): array
	{
		$info = ['productId' => 0, 'info' => 'deleteOrderError'];
		$select = (new OrderItemRepository())->deleteEmptyOrderItem($id);
		if (empty($select))
		{
			return $info;
		}
		$info['info'] = 'deleteOrderOk';
		$info['productId'] = $select;
		return $info;
	}

	public static function updateOrderItemList($order):string
	{
		$orderArr = [
			'ID' => (int)$order[0],
			'PRODUCT_ID' => (int)$order[1],
			'ORDER_ID' => (int)$order[2],
			'COUNT' => (int)$order[3],
			'PRICE' => (float)$order[4],
			'NAME' => $order[5],
		];

		return (new OrderItemRepository())->updateOrderItem($orderArr);
	}
}