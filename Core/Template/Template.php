<?php

namespace Eshop\Core\Template;

class Template
{
	/**
	 * Локация шаблона
	 *
	 * @var string
	 */
	public $folder;

	/*
	 * Определить при создании папку с шаблонами
	 */
	function __construct($folder = null)
	{
		if ($folder)
		{
			$this->set_folder($folder);
		}
	}

	/*
	 * Позволяет в случае чего поменять папку для шаблонов
	 */
	function set_folder($folder)
	{
		$this->folder = rtrim($folder, '/');
	}

	/*
	 * принимает в $suggestions необходимый нам шаблон
	 * и нужные для него данные в качестве второго параметра.
	 */
	function render($suggestions, $variables = [])
	{
		$template = $this->find_template($suggestions);
		$output = "";
		if ($template)
		{
			$output = $this->render_template($template, $variables);
		}
		return $output;
	}

	/*
	 * Функция для поиска шаблона
	 *
	 * @param $suggestions
	 * @return bool|string
	 */
	function find_template($suggestions)
	{
		if (!in_array($suggestions))
		{
			$suggestions = [$suggestions];
		}
		$suggestions = array_reverse($suggestions);
		$found = false;
		foreach ($suggestions as $suggestion)
		{
			$file = "{$this->folder}/{$suggestions}.php";
			if (file_exists($file))
			{
				$found = $file;
				break;
			}
		}
		return $found;
	}

	/*
	 * Закидываем все в буффер и по окончанию
	 * возвращаем контент, который надо отобразить
	 */
	function render_template($template, $variables)
	{
		ob_start();
		foreach (func_get_args()[1] as $key => $value)
		{
			${$key} = $value;
		}
		include func_get_args()[0];
		return ob_get_clean();
	}
}