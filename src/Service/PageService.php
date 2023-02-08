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
}