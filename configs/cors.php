<?php

/**
 * Configure your setting for cross-origin resource sharing
 */
$cors = [
	# Allow cross-origin requests from any origin
	'access_control_allow_origin' => ['*'],
	'access_control_allow_methods' => ['*'],
	'access_control_allow_headers' => [
		'content_type',
		'access_control_allow_headers',
		'authorization',
	],

	# ...you can add as many header as needed
];
