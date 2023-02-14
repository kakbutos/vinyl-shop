<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Models\TableField;
use Eshop\src\Service\MainService;
use Eshop\src\Service\AdminService;

class AdminController
{
	public function getAdmin(): string
	{
		$render = new Template('../src/Views');
		$tags = MainService::getTagsList();
		json_encode($data = ['heh', 'hah', 'hoh']);

		return $render->render('admin', [
			'data' => $data,
		]);
	}

	public function getProductList()
	{
		$list = AdminService::getProductList();
		$table = [
			new TableField('ID', 'id', 'ID'),
			new TableField('Название', 'text', 'NAME'),
			new TableField('Треки', 'text', 'TRACKS'),
			new TableField('Качество винила', 'text', 'VINIL_STATUS'),
			new TableField('Качество конверта', 'text', 'COVER_STATUS'),
			new TableField('Цена', 'number', 'PRICE'),
			new TableField('Дата релиза', 'number', 'RELEASE_DATE'),
			new TableField('Активен', 'bool', 'IS_ACTIVE'),
			new TableField('Исполнитель', 'text', 'ARTIST'),
		];
		$data = [[2, 'fqwfqwfwq To Hell', 'A2 Hisafasasghway To Hell',
				'G-', 'Класный', 5580, 1979, true, 'AC/DC'], [2, 'fqwfqwfwq To Hell', 'A2 Hisafasasghway To Hell',
				'G-', 'Класный', 5580, 2000, true, 'AC/DC']];
		// echo '<pre>';
		// print_r($list);
		if ($_GET['text'] === 'product')
		{
			$data = json_encode([$table,$data], JSON_THROW_ON_ERROR);
		}



		return $data;
	}
}