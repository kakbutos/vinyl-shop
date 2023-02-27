<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Lib\AuthHelper;
use Eshop\src\Service\OrderItemService;

class OrderItemController
{
	public function getOrderItems(int $id): string
	{
		if (!UserAdminController::isAuthorized())
		{
			header("Location: " . AuthHelper::getUrl() . "/login");
		}

		$list = OrderItemService::getOrderItemList($id);
		$render = new Template('../src/Views');
		return $render->render('admin/order', [
			"orderList" => $list,
			"orderId" => $id,
		]);
	}

	public function addOrderItem(int $id): void
	{
		if (!UserAdminController::isAuthorized())
		{
			header("Location: " . AuthHelper::getUrl() . "/login");
		}

		$orderId = OrderItemService::addOrderItemList($id);
		header("Location: " . AuthHelper::getUrl() . "/admin/order/{$orderId}/");
	}

	public function deleteOrderItem(int $id): void
	{
		if (!UserAdminController::isAuthorized())
		{
			header("Location: " . AuthHelper::getUrl() . "/login");
		}

		$orderId = OrderItemService::deleteOrderItemList($id);
		header("Location: " . AuthHelper::getUrl() . "/admin/order/{$orderId}/");
	}

	public function updateOrderItem(int $id):void
	{
		if (!UserAdminController::isAuthorized())
		{
			header("Location: " . AuthHelper::getUrl() . "/login");
		}

		$orderId = $_POST['ID'];
		$productId = $_POST['PRODUCT_ID'];
		$productOrderId = $_POST['ORDER_ID'];
		$productCount = $_POST['COUNT'];
		$productPrice = $_POST['PRICE'];
		$productName = $_POST['NAME'];

		$order = [
			$orderId, $productId, $productOrderId, $productCount, $productPrice, $productName
		];


		$result = OrderItemService::updateOrderItemList($order);

		header("Location: " . AuthHelper::getUrl() . "/admin/order/{$productOrderId}/");
	}
}