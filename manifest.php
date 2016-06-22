<?php

return array(
	'name' => 'ai-fosuser',
	'depends' => array(
		'aimeos-core',
	),
	'include' => array(
		'lib/custom/src',
	),
	'config' => array(
		'lib/custom/config',
	),
	'setup' => array(
		'lib/custom/setup',
	),
);
