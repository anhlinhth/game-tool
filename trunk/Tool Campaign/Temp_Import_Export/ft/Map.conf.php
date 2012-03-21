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
		'blocks' => array(MAP_BLOCK_0 => null),
		'freeWorker' => 3
	),
	MAP_2 => array
	(
		'type' => MAP,
		'name' => 'Làng Bí Ẩn 2',
		'needMap' => BARRACK_2,
		'nextMap' => BARRACK_3,
		'width' => 40,
		'heigh' => 40,
		'blocks' => array(MAP_BLOCK_0 => null),
		'freeWorker' => 1
	),
	MAP_3 => array
	(
		'type' => MAP,
		'name' => 'Làng Bí Ẩn 3',
		'needMap' => MAP_2,
		'nextMap' => null,
		'width' => 40,
		'heigh' => 40,
		'blocks' => array(MAP_BLOCK_0 => null),
		'freeWorker' => 1
	),
	
	/**********************************************************************/
	
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
		'nextMap' => MAP_2,
	)
	,
	BARRACK_3 => array
	(
		'type' => BARRACK,
		'needMap' => MAP_2,
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
		'nextMap' => MAP_3,
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
		'nextMap' => MAP_3,
	)
);
?>