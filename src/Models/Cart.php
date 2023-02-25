<?php

namespace Eshop\src\Models;

use Exception;

class Cart
{
	public function addProduct(Product $product, $quantity = 1): void
	{
		if (isset($_SESSION['cart'][$product->getId()]))
		{
			$_SESSION['cart'][$product->getId()]['qty'] += $quantity;
		}
		else
		{
			$_SESSION['cart'][$product->getId()] = [
				'artist' => $product->getArtist(),
				'name' => $product->getName(),
				'price' => $product->getPrice(),
				'qty' => $quantity,
				'img' => $product->getImageList()[0]->getPath(),
			];
		}
		$_SESSION['cartQty'] = isset($_SESSION['cartQty']) ? $_SESSION['cartQty'] + $quantity : $quantity;
		$_SESSION['cartSum'] = isset($_SESSION['cartSum']) ? $_SESSION['cartSum'] + $product->getPrice() * $quantity : $quantity * $product->getPrice();
	}

	/**
	 * @throws Exception
	 */
	public function reduceProductQuantity(Product $product, $quantity = 1): bool
	{
		if (!isset($_SESSION['cart'][$product->getId()]))
		{
			return false;
		}
		if ($_SESSION['cart'][$product->getId()]['qty'] <= $quantity)
		{
			$this->deleteProduct($product->getId());

			return true;
		}

		$_SESSION['cart'][$product->getId()]['qty'] -= $quantity;

		$_SESSION['cartQty'] = isset($_SESSION['cartQty']) ? $_SESSION['cartQty'] - $quantity : $quantity;
		$_SESSION['cartSum'] = isset($_SESSION['cartSum']) ? $_SESSION['cartSum'] - $product->getPrice() * $quantity : $quantity * $product->getPrice();

		return true;
	}

	public function getTotalQuantity(): int
	{
		if(isset($_SESSION['cart']))
		{
			return $_SESSION['cartQty'];
		}

		return 0;
	}

	public function getTotalSum(): int
	{
		if(isset($_SESSION['cart']))
		{
			return $_SESSION['cartSum'];
		}

		return 0;
	}

	public function getCart(): array
	{
		return $_SESSION['cart'] ?? [];
	}

	/**
	 * @throws Exception
	 */
	public function deleteProduct($productId): void
	{
		if(isset($_SESSION['cart'][$productId]))
		{
			$_SESSION['cartQty'] -= $_SESSION['cart'][$productId]['qty'];
			$_SESSION['cartSum'] -= $_SESSION['cart'][$productId]['qty'] * $_SESSION['cart'][$productId]['price'];
			unset($_SESSION['cart'][$productId]);
		}
		else
		{
			throw new Exception("There is no product with this id.");
		}
	}
}