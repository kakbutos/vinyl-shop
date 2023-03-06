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

		$info = '';
		if (isset($_GET['info']))
		{
			$info = $_GET['info'];
		}

		$list = OrderItemService::getOrderItemList($id);
		$render = new Template('../src/Views');
		return $render->render('admin/order', [
			'info' => $render->render('/components/adminInfo', ['info' => $info]),
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

		$info = OrderItemService::deleteOrderItemList($id);
		if ($info['productId'] === 0)
		{
			header("Location: " . AuthHelper::getUrl() . "/admin");
		}
		header("Location: " . AuthHelper::getUrl() . "/admin/order/{$info['productId']}/?info={$info['info']}");
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

		$info = OrderItemService::updateOrderItemList($order);

		header("Location: " . AuthHelper::getUrl() . "/admin/order/{$productOrderId}/?info={$info}");
	}
}