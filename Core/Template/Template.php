<?php

namespace Eshop\Template;

class Template
{
	public $folder;

	function _construct($folder = null)
	{
		if ($folder)
		{
			$this->set_folder($folder);
		}
	}

	function set_folder($folder)
	{
		$this->folder = rtrim($folder, '/');
	}

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