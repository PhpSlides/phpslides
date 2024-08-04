<?php

/**
 *
 * @param array $trace
 * @return array
 */
function filterTrace(array $trace)
{
	/**
	 * This Filter and removes all file path that is coming from the vendor folders
	 */
	$majorFilter = array_filter($trace, function ($item) {
		$ss = strpos($item['file'], '/vendor/') === false;
		$sss = strpos($item['file'], '\vendor\\') === false;

		return $ss && $sss === true;
	});

	/**
	 * This filters and add only file path from the vendor folders
	 */
	$minorFilter = array_filter($trace, function ($item) {
		$ss = strpos($item['file'], '/vendor/') !== false;
		$sss = strpos($item['file'], '\vendor\\') !== false;

		return $ss || $sss === true;
	});

	/**
	 * Create a new array and merge them together
	 * Major filters first
	 * Then the Minor filters follows
	 */
	$majorFilterValue = array_values($majorFilter);
	$minorFilterValue = array_values($minorFilter);
	$newFilter = array_merge($majorFilterValue, $minorFilterValue);

	return $newFilter;
}
