<?php
return array
(
	MAP_1 => array
	(
		'type' => MAP,
		'name' => 'Làng Bí Ẩn',
		'needMap' => null,
		'nextMap' => BARRACK_1,
		'width' => 40,
		'heigh' => 40,
		'blocks' => array( 0 => null, 1 => null, 5 => null, 6 => null ),
		'freeWorker' => 0
	),
	BARRACK_1 => array
	(
		'type' => BARRACK,
		'needMap' => MAP_1,
		'nextMap' => BARRACK_2,
	),
	BARRACK_2 => array
	(
		'type' => BARRACK,
		'needMap' => BARRACK_1,
		'nextMap' => BARRACK_3,
	)
	,
	BARRACK_3 => array
	(
		'type' => BARRACK,
		'needMap' => BARRACK_2,
		'nextMap' => BARRACK_4,
	)
	,
	BARRACK_4 => array
	(
		'type' => BARRACK,
		'needMap' => BARRACK_3,
		'nextMap' => BARRACK_5,
	)
	,
	BARRACK_5 => array
	(
		'type' => BARRACK,
		'needMap' => BARRACK_4,
		'nextMap' => BARRACK_6,
	),
	BARRACK_6 => array
	(
		'type' => BARRACK,
		'needMap' => BARRACK_5,
		'nextMap' => BARRACK_7,
	),
	BARRACK_7 => array
	(
		'type' => BARRACK,
		'needMap' => BARRACK_6,
		'nextMap' => BARRACK_8,
	),
	BARRACK_8 => array
	(
		'type' => BARRACK,
		'needMap' => BARRACK_7,
		'nextMap' => MAP_2,
	),
	MAP_2 => array
	(
		'type' => MAP,
		'name' => 'Làng Bí Ẩn 2',
		'needMap' => BARRACK_8,
		'nextMap' => BARRACK_9,
		'width' => 40,
		'heigh' => 40,
		'blocks' => array(MAP_BLOCK_0 => null),
		'freeWorker' => 1
	),
	BARRACK_9 => array
	(
		'type' => BARRACK,
		'needMap' => MAP_2,
		'nextMap' => BARRACK_10,
	),
	BARRACK_10 => array
	(
		'type' => BARRACK,
		'needMap' => BARRACK_9,
		'nextMap' => BARRACK_11,
	),
	BARRACK_11 => array
	(
		'type' => BARRACK,
		'needMap' => BARRACK_10,
		'nextMap' => BARRACK_12,
	),
	BARRACK_12 => array
	(
		'type' => BARRACK,
		'needMap' => BARRACK_11,
		'nextMap' => BARRACK_13,
	),
	BARRACK_13 => array
	(
		'type' => BARRACK,
		'needMap' => BARRACK_12,
		'nextMap' => BARRACK_13,
	),
	BARRACK_14 => array
	(
		'type' => BARRACK,
		'needMap' => BARRACK_13,
		'nextMap' => BARRACK_15,
	),
	BARRACK_15 => array
	(
		'type' => BARRACK,
		'needMap' => BARRACK_14,
		'nextMap' => BARRACK_16,
	),
	BARRACK_16 => array
	(
		'type' => BARRACK,
		'needMap' => BARRACK_15,
		'nextMap' => MAP_3,
	),
	MAP_3 => array
	(
		'type' => MAP,
		'name' => 'Làng Bí Ẩn 3',
		'needMap' => BARRACK_16,
		'nextMap' => null,
		'width' => 40,
		'heigh' => 40,
		'blocks' => array(MAP_BLOCK_0 => null),
		'freeWorker' => 1
	),
);
?>