<?php

namespace Eshop\src\Service;

class PageService
{
	// Разделение треков по сторонам пластинки
	public static function formatTrackForDetailPage(array $tracks):array
	{
		foreach ($tracks as $i => $item)
		{
			if (strpos($item, 'B1') === 0)
			{
				return [array_slice($tracks, 0, $i), array_slice($tracks, $i)];
			}
		}

		return [];
	}

	// Обрезание текста, который превышает максимальную длину
	public static function truncate(string $text, ?int $maxLength = null): string
	{
		if ($maxLength === null)
		{
			return $text;
		}

		$cropped = mb_strimwidth($text, 0, $maxLength);
		if ($cropped !== $text)
		{
			return $cropped . "...";
		}
		return $text;
	}
}