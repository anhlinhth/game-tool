<?php
return array
(
	CONFIG_DEFAULT_VALUE => array
	(
		'type' => null,
		'level' => null,
		'buyPrice' => null,
		'requireLevel' => null
	),

	31001 => array
	(
		'type' => SOLDIER_HERO_NORMAL_1,
		'level' => 10,
		'buyPrice' => array(GOLD => 800, COIN => 10)
	),
	31002 => array
	(
		'type' => SOLDIER_HERO_NORMAL_2,
		'level' => 15,
		'buyPrice' => array(GOLD => 1200, COIN => 15)
	),
	31003 => array
	(
		'type' => SOLDIER_HERO_NORMAL_3,
		'level' => 20,
		'buyPrice' => array(GOLD => 1600, COIN => 20)
	),
);
?>