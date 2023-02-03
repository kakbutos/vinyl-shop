<?php

namespace Eshop\models;

use Exception;

class Tag
{
	private string $id;
	private string $title;

	/**
	 * @throws Exception
	 */
	public function __construct (
		string $title,
		?string $id = null
	)
	{
		$this->id = $id ?? uniqid('', false);
		$this->setTitle($title);
	}

	public function getId(): string
	{
		return $this->id;
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @throws Exception
	 */
	public function setTitle(string $title): void
	{
		$title = trim($title);
		if ($title === '')
		{
			throw new Exception('Title cannot be empty');
		}

		$this->title = $title;
	}
}