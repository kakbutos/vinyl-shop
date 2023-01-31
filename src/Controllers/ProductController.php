<?php

namespace Eshop\Controllers;

class ProductController
{
	public function detailsAction(string $id): string
	{
		return "product page $id";
	}
}