<?php

namespace Eshop\src\Models;

use Exception;

class Order
{
	private string $orderId;
	private string $productId;
	private \DateTime $createdAt;
	private string $customerName;
	private string $customerEmail;
	private string $customerPhone;
	private string $count;
	private string $price;
	private ?string $comment = null;
	private ?string $status;

	/**
	 * @throws Exception
	 */
	public function __construct(
		// ?string $orderId,
		string $productId,
		string $customerName,
		string $customerEmail,
		string $customerPhone,
		string $count,
		string $price,
		?string $comment,
		string $status = 'CREATE',
		?\DateTime $createdAt = null
	)
	{
		// $this->orderId = $orderId;
		$this->productId = $productId;
		$this->setCustomerName($customerName);
		$this->setCustomerEmail($customerEmail);
		$this->setCustomerPhone($customerPhone);
		$this->setCount($count);
		$this->price = $price;
		$this->setComment($comment);
		$this->setStatus($status);
		$this->createdAt = $createdAt ?? new \DateTime();
	}

	public function setOrderId(string $orderId): void
	{
		$this->orderId = $orderId;
	}

	/**
	 * @throws Exception
	 */
	public function setCustomerName(string $customerName): void
	{
		$customerName = trim($customerName);
		if ($customerName === '')
		{
			throw new Exception('Field "Name" cannot be empty');
		}

		$this->customerName = $customerName;
	}

	/**
	 * @throws Exception
	 */
	public function setCustomerEmail(string $customerEmail): void
	{
		$customerEmail = trim($customerEmail);
		if (filter_var($customerEmail, FILTER_VALIDATE_EMAIL) === false)
		{
			throw new Exception('E-mail is incorrect');
		}

		$this->customerEmail = $customerEmail;
	}

	/**
	 * @throws Exception
	 */
	public function setCustomerPhone($customerPhone): void
	{
		$customerPhone = trim($customerPhone);
		if($customerPhone === '')
		{
			throw new Exception('Field "Phone" cannot be empty');
		}

		$this->customerPhone = $customerPhone;
	}

	public function setComment($comment): void
	{
		$comment = trim($comment);
		$this->comment = $comment;
	}

	public function setCount($count): void
	{
		$this->count = $count;
	}

	public function setPrice($price): void
	{
		$this->price = $price;
	}

	public function setStatus($status): void
	{
		$this->status = $status;
	}

	public function getOrderId(): string
	{
		return $this->orderId;
	}

	public function getProductId(): string
	{
		return $this->productId;
	}

	public function getCreatedAt(): \DateTime
	{
		return $this->createdAt;
	}

	public function getCustomerName(): string
	{
		return $this->customerName;
	}

	public function getCustomerEmail(): string
	{
		return $this->customerEmail;
	}

	public function getCustomerPhone(): string
	{
		return $this->customerPhone;
	}

	public function getComment(): string
	{
		return $this->comment;
	}

	public function getCount(): string
	{
		return $this->count;
	}

	public function getPrice(): string
	{
		return $this->price;
	}

	public function getStatus(): string
	{
		return $this->status;
	}
}