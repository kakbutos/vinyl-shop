<?php

namespace Eshop\src\Models;

use Exception;

class Tag
{
	private string $id;
	private string $title;

	/**
	 * @throws Exception
	 */
	public function __construct (
		string $id,
		string $title
	)
	{
		$this->id = $id;
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