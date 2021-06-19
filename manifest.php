<?php

return [
	'name' => 'ai-fosuser',
	'depends' => [
		'aimeos-core',
	],
	'include' => [
		'lib/custom/src',
	],
	'config' => [
		'lib/custom/config',
	],
	'setup' => [
		'lib/custom/setup',
	],
];
