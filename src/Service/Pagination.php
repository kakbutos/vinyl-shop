<?php

namespace Eshop\src\Service;

class Pagination
{
	public int $count_pages = 1; // количество страниц в пагинации
	public int $current_page = 1; // текущая страница
	public string $uri = ''; // url страницы

	public int $page; // номер страницы
	public int $per_page; // количество элементов на одну страницу
	public int $total; // общее количество страниц

	public function __construct(
		int $page = 1,
		int $per_page = 1,
		int $total = 1
	)
	{
		$this->page = $page;
		$this->per_page = $per_page;
		$this->total = $total;
		$this->count_pages = $this->get_count_pages();
		$this->current_page = $this->get_current_pages();
		$this->uri = $this->get_params();
	}

	// с какого элемента начинать выборку
	public function get_start(): int
	{
		return ($this->current_page - 1) * $this->per_page;
	}

	public function get_count_pages(): int
	{
		return ceil($this->total / $this->per_page) ?: 1;
	}

	public function get_current_pages(): int
	{

		if ($this->page < 1)
		{
			$this->page = 1;
		}

		if ($this->page > $this->count_pages)
		{
			$this->page = $this->count_pages;
		}

		return $this->page;
	}

	public function get_html(): string
	{
		$back = '';
		$forward = '';
		$start_page = '';
		$end_page = '';
		$pages_left = '';
		$pages_right = '';

		if ($this->current_page > 1)
		{
			$back = "<li class='page-item'><a class='page-link' href='" . $this->get_link($this->current_page - 1) . "'>&lt;</a></li>";
		}

		if ($this->current_page < $this->count_pages)
		{
			$forward = "<li class='page-item'><a class='page-link' href='" . $this->get_link($this->current_page + 1) . "'>&gt;</a></li>";
		}

		if ($this->current_page > $this->mid_size + 1)
		{
			$start_page = "<li class='page-item'><a class='page-link' href='" . $this->get_link(1) . "'>&laquo;</a></li>";
		}

		if ($this->current_page < ($this->count_pages - $this->mid_size))
		{
			$end_page = "<li class='page-item'><a class='page-link' href='" . $this->get_link($this->count_pages) . "'>&raquo;</a></li>";
		}

		for ($i = $this->mid_size; $i > 0; $i--)
		{
			if ($this->current_page - $i > 0)
			{
				$pages_left .= "<li class='page-item'><a class='page-link' href='" . $this->get_link($this->current_page - $i) . "'>" . ($this->current_page - $i) . "</a></li>";
			}
		}

		for ($i = 1; $i <= $this->mid_size; $i++)
		{
			if ($this->current_page + $i <= $this->count_pages)
			{
				$pages_right .= "<li class='page-item'><a class='page-link' href='" . $this->get_link($this->current_page + $i) . "'>" . ($this->current_page + $i) . "</a></li>";
			}
		}

		return '<nav aria-label="Page navigation example"><ul class="pagination">' . $start_page . $back . $pages_left . '<li class="page-item active"><a class="page-link active">' . $this->current_page . '</a></li>' . $pages_right . $forward . $end_page . '</ul></nav>';

	}

	public function get_link($page): string
	{
		if ($page == 1)
		{
			return rtrim($this->uri, '?&');
		}

		if (strpos($this->uri, '&'))
		{
			return "{$this->uri}page={$page}";
		}
		else
		{
			if (strpos($this->uri, '?'))
			{
				return "{$this->uri}page={$page}";
			}
			else
			{
				return "{$this->uri}?page={$page}";
			}
		}
	}

	// вырезает параметр page в url
	public function get_params(): string
	{
		$url = $_SERVER['REQUEST_URI'];
		$url = explode('?', $url);
		$uri = $url[0];

		if (isset($url[1]) && $url[1] != '')
		{
			$uri .= '?';
			$params = explode('&', $url[1]);

			foreach ($params as $param)
			{
				if (!preg_match("#page=#", $param)) $uri .= "{$param}&";
			}
		}

		return $uri;
	}
}