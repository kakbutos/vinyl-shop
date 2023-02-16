<?php

namespace Eshop\src\Models;

class TableField
{
	public string $name;
	public string $type;
	public string $field;

	public function __construct (string $name, string $type, string $field)
	{
		$this->name = $name;
		$this->type = $type;
		$this->field = $field;
	}
}