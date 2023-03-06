<?php

namespace Eshop\src\Service;

class PageService
{
	// Разделение треков по сторонам пластинки
	public static function formatTrackForDetailPage(array $tracks):array
	{
		if (empty($tracks))
		{
			return ['Нет информации'];
		}
		$i = round(count($tracks) / 2);

		if (count($tracks) === 1)
		{
			return $tracks;
		}

		return [array_slice($tracks, 0, $i), array_slice($tracks, $i)];
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

	public static function safe(string $value): string
	{
		return htmlspecialchars($value, ENT_QUOTES);
	}
}