<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Lib\AuthHelper;
use Eshop\src\Service\OrderItemService;

class OrderItemController
{
	public function getOrderItems(int $id): string
	{
		if (!userAdminController::isAuthorized()) header("Location: " . AuthHelper::getUrl() . "/login");

		$list = OrderItemService::getOrderItemList($id);
		$render = new Template('../src/Views');
		return $render->render('order', [
			"orderList" => $list,
			"orderId" => $id,
		]);
	}

	public function addOrderItem(int $id): void
	{
		if (!userAdminController::isAuthorized())
		{
			header("Location: " . AuthHelper::getUrl() . "/login");
		}
		$orderItem = OrderItemService::addOrderItemList($id);
		header("Location: " . AuthHelper::getUrl() . "/admin/order/{$orderItem}/");
	}

	public function deleteOrderItem(int $id): void
	{
		if (!userAdminController::isAuthorized())
		{
			header("Location: " . AuthHelper::getUrl() . "/login");
		}
		$orderItem = OrderItemService::deleteOrderItemList($id);
		header("Location: " . AuthHelper::getUrl() . "/admin/order/{$orderItem}/");
	}

}