<?php

namespace Eshop\src\Models;

use Exception;

class Order
{
	private string $orderId;
	private array $productId;
	private \DateTime $createdAt;
	private string $customerName;
	private string $customerEmail;
	private string $customerPhone;
	private ?string $comment = null;
	private string $status;

	/**
	 * @throws Exception
	 */
	public function __construct(
		array $productId,
		string $customerName,
		string $customerEmail,
		string $customerPhone,
		?string $comment,
		string $status = 'CREATE',
		?\DateTime $createdAt = null
	)
	{
		$this->productId = $productId;
		$this->createdAt = $createdAt ?? new \DateTime();
		$this->setCustomerName($customerName);
		$this->setCustomerEmail($customerEmail);
		$this->setCustomerPhone($customerPhone);
		$this->setComment($comment);
		$this->setStatus($status);
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

	public function setStatus($status): void
	{
		$this->status = $status;
	}

	public function getProductId(): array
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

	public function getStatus(): string
	{
		return $this->status;
	}
}