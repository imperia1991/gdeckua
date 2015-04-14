<?php
return [
	'components' => [
		'db'     => [
			'connectionString' => 'mysql:host=localhost;dbname=gdeckua',
			'emulatePrepare'   => true,
			'username'         => 'root',
			'password'         => 'root',
			'charset'          => 'utf8',
		],
	],
	'params' => [
		'siteUrl' => 'http://gdeckua.local/'
	]
];


 