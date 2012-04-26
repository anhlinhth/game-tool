<?php
return array
(
	CONFIG_DEFAULT_VALUE => array
	(
		'type' => null,
		'buyPrice' => null,
		'requireLevel' => null
	),

	/*********************Building Tab - Start************************/
	0 => array
	(
		'type' => BUILDING_HOUSE,
		'buyPrice' => array(GOLD => 400, WOOD => 6, IRON => 5),
	),

	2 => array
	(
		'type' => BUILDING_FARM,
		'buyPrice' => array(GOLD => 50),
	),

	9 => array
	(
		'type' => BUILDING_BARRACK,
		'buyPrice' => array(GOLD => 300, IRON => 10, WOOD => 30),
	),

	56 => array
	(
		'type' => BUILDING_HOUSE_2,
		'buyPrice' => array(GOLD => 450, WOOD => 7, IRON => 5),
	),
	57 => array
	(
		'type' => BUILDING_HOUSE_3,
		'buyPrice' => array(GOLD => 500, WOOD => 8, IRON => 6),
	),

	58 => array
	(
		'type' => BUILDING_CREATE_POP,
		'buyPrice' => array(WOOD => 30),
	),
	59 => array
	(
		'type' => BUILDING_BARRACK_KYBINH,
		'buyPrice' => array(GOLD => 300, IRON => 30, STONE => 10),
	),
	60 => array
	(
		'type' => BUILDING_BARRACK_PHAOBINH,
		'buyPrice' => array(GOLD => 300, WOOD => 10, STONE => 30),
	),
	61 => array
    (
        'type' => BUILDING_MILITARY_RESLAB,
        'buyPrice' => array(GOLD => 300, STONE => 30, WOOD => 10),
    ),
    62 => array
    (
        'type' => BUILDING_HERO_1,
        'buyPrice' => array(GOLD => 100, IRON => 10, WOOD => 10),
    	'requireLevel' => 1
    ),
    63 => array
    (
        'type' => BUILDING_HERO_2,
        'buyPrice' => array(GOLD => 100, IRON => 10, WOOD => 10),
    	'requireLevel' => 1
    ),
	64 => array
	(
		'type' => BUILDING_HERO_3,
		'buyPrice' => array(GOLD => 100, IRON => 10, WOOD => 10),
		'requireLevel' => 1
	),
	/*********************Building Tab - End************************/

	/*********************Decor Tab - Start************************/
	4 => array
	(
		'type' => BUILDING_DECO_1,
		'buyPrice' => array(GOLD => 10, IRON => 1, WOOD => 1),
	),

	5 => array
	(
		'type' => BUILDING_DECO_2,
		'buyPrice' => array(GOLD => 15, IRON => 1, WOOD => 1),
		'requireLevel' => 2,
	),

	6 => array
	(
		'type' => BUILDING_DECO_3,
		'buyPrice' => array(COIN => 7),
		'requireLevel' => 5
	),

	7 => array
	(
		'type' => BUILDING_DECO_4,
		'buyPrice' => array(COIN => 7),
		'requireLevel' => 10
	),

	8 => array
	(
		'type' => BUILDING_DECO_5,
		'buyPrice' => array(COIN => 7),
		'requireLevel' => 10
	),

	11 => array
	(
		'type' => BUILDING_DECO_6,
		'buyPrice' => array(GOLD => 250, IRON => 12, WOOD => 10),
	),

	12 => array
	(
		'type' => BUILDING_DECO_7,
		'buyPrice' => array(GOLD => 250, IRON => 12, WOOD => 10),
	),

	13 => array
	(
		'type' => BUILDING_DECO_8,
		'buyPrice' => array(GOLD => 250, IRON => 12, WOOD => 10),
		'requireLevel' => 5
	),

	16 => array
	(
		'type' => BUILDING_DECO_11,
		'buyPrice' => array(COIN => 29),
	),

	17 => array
	(
		'type' => BUILDING_DECO_12,
		'buyPrice' => array(GOLD => 4000, IRON => 188, WOOD => 160),
	),

	18 => array
	(
		'type' => BUILDING_DECO_13,
		'buyPrice' => array(GOLD => 4000, IRON => 188, WOOD => 160),
	),

	19 => array
	(
		'type' => BUILDING_DECO_14,
		'buyPrice' => array(COIN => 25),
	),

	20 => array
	(
		'type' => BUILDING_DECO_15,
		'buyPrice' => array(COIN => 25),
		'requireLevel' => 1
	),

	21 => array
	(
		'type' => BUILDING_DECO_16,
		'buyPrice' => array(COIN => 25),
		'requireLevel' => 10
	),

	22 => array
	(
		'type' => BUILDING_DECO_17,
		'buyPrice' => array(COIN => 25),
	),

	23 => array
	(
		'type' => BUILDING_DECO_18,
		'buyPrice' => array(COIN => 25),
	),

	24 => array
	(
		'type' => BUILDING_DECO_19,
		'buyPrice' => array(COIN => 15),
	),

	25 => array
	(
		'type' => BUILDING_DECO_20,
		'buyPrice' => array(COIN => 25),
		'requireLevel' => 10
	),

	26 => array
	(
		'type' => BUILDING_DECO_21,
		'buyPrice' => array(COIN => 25),
		'requireLevel' => 10
	),

	27 => array
	(
		'type' => BUILDING_DECO_22,
		'buyPrice' => array(GOLD => 1000),
	),

	28 => array
	(
		'type' => BUILDING_DECO_23,
		'buyPrice' => array(GOLD => 1000),
	),


	29 => array
	(
		'type' => BUILDING_DECO_24,
		'buyPrice' => array(GOLD => 1000),
	),

	30 => array
	(
		'type' => BUILDING_DECO_25,
		'buyPrice' => array(GOLD => 1000)
	),

	31 => array
	(
		'type' => BUILDING_DECO_26,
		'buyPrice' => array(GOLD => 1000)
	),

	32 => array
	(
		'type' => BUILDING_DECO_27,
		'buyPrice' => array(GOLD => 1000),
		'requireLevel' => 2
	),

	33 => array
	(
		'type' => BUILDING_DECO_28,
		'buyPrice' => array(GOLD => 1000)
	),

	34 => array
	(
		'type' => BUILDING_DECO_29,
		'buyPrice' => array(GOLD => 1000)
	),

	35 => array
	(
		'type' => BUILDING_DECO_30,
		'buyPrice' => array(GOLD => 1000)
	),

	36 => array
	(
		'type' => BUILDING_DECO_31,
		'buyPrice' => array(GOLD => 1000)
	),

	37 => array
	(
		'type' => BUILDING_DECO_32,
		'buyPrice' => array(GOLD => 1000)
	),

	38 => array
	(
		'type' => BUILDING_DECO_33,
		'buyPrice' => array(GOLD => 1000)
	),

	39 => array
	(
		'type' => BUILDING_DECO_34,
		'buyPrice' => array(GOLD => 1000)
	),

	44 => array
	(
		'type' => BUILDING_DECO_39,
		'buyPrice' => array(GOLD => 250, IRON => 12, WOOD => 10),
		'requireLevel' => 2
	),

	45 => array
	(
		'type' => BUILDING_DECO_40,
		'buyPrice' => array(GOLD => 250, IRON => 12, WOOD => 10),
		'requireLevel' => 2
	),

	49 => array
	(
		'type' => BUILDING_DECO_44,
		'buyPrice' => array(GOLD => 1000),
		'requireLevel' => 5
	),

	/*********************Decor Tab - End************************/

	/*********************Civ Tab - Start************************/
	800 => array
	(
		'type' => BUILDING_CIV_1,
		'buyPrice' => array(GOLD => 1000),
		'requireLevel' => 6
	),

    801 => array
    (
        'type' => BUILDING_CIV_2,
        'buyPrice' => array(GOLD => 4000, STONE => 132, IRON => 108),
    	'requireLevel' => 11
    ),

    802 => array
    (
        'type' => BUILDING_CIV_3,
        'buyPrice' => array(GOLD => 19000, STONE => 627, IRON => 513),
    	'requireLevel' => 16
    ),


    803 => array
    (
        'type' => BUILDING_CIV_4,
        'buyPrice' => array(GOLD => 6000, STONE => 198, IRON => 162),
    	'requireLevel' => 21
    ),

	/*804 => array
    (
        'type' => BUILDING_CIV_5,
        'buyPrice' => array(GOLD => 13000, STONE => 429, IRON => 351)
    ),

    805 => array
    (
        'type' => BUILDING_CIV_6,
        'buyPrice' => array(GOLD => 13000, STONE => 429, IRON => 351)
    ),

    806 => array
    (
        'type' => BUILDING_CIV_7,
        'buyPrice' => array(GOLD => 13000, STONE => 429, IRON => 351 )
    ),

    807 => array
    (
        'type' => BUILDING_CIV_8,
        'buyPrice' => array(GOLD => 6000, STONE => 198, IRON => 162)
    ),


    808 => array
    (
        'type' => BUILDING_CIV_9,
        'buyPrice' => array(GOLD => 19000, STONE => 627, IRON => 513)
    ),

    809 => array
    (
        'type' => BUILDING_CIV_10,
        'buyPrice' => array(GOLD => 6000, STONE => 198, IRON => 162)
    ),

    810 => array
    (
        'type' => BUILDING_CIV_11,
        'buyPrice' => array(GOLD => 19000, STONE => 627, IRON => 513)
    ),

    811 => array
    (
        'type' => BUILDING_CIV_12,
        'buyPrice' => array(GOLD => 13000, STONE => 429, IRON => 351)
    ),

    812 => array
    (
        'type' => BUILDING_CIV_13,
        'buyPrice' => array(GOLD => 6000, STONE => 198, IRON => 162)
    ),

    813 => array
    (
        'type' => BUILDING_CIV_14,
        'buyPrice' => array(GOLD => 19000, STONE => 627, IRON => 513)
    ),

    814 => array
    (
        'type' => BUILDING_CIV_15,
        'buyPrice' => array(GOLD => 19000, STONE => 627, IRON => 513)
    ),

    815 => array
    (
        'type' => BUILDING_CIV_16,
        'buyPrice' => array(GOLD => 13000, STONE => 429, IRON => 351)
    ),

    816 => array
    (
        'type' => BUILDING_CIV_17,
        'buyPrice' => array(GOLD => 13000, STONE => 429, IRON => 351)
    ),

    817 => array
    (
        'type' => BUILDING_CIV_18,
        'buyPrice' => array(GOLD => 19000, STONE => 627, IRON => 513)
    ),

    818 => array
    (
        'type' => BUILDING_CIV_19,
        'buyPrice' => array(GOLD => 13000, STONE => 429, IRON => 351)
    ),

    819 => array
    (
        'type' => BUILDING_CIV_20,
        'buyPrice' => array(GOLD => 25000, STONE => 825, IRON => 675)
    ),

    820 => array
    (
        'type' => BUILDING_CIV_21,
        'buyPrice' => array(GOLD => 13000, STONE => 429, IRON => 351)
    ),

    821 => array
    (
        'type' => BUILDING_CIV_22,
        'buyPrice' => array(GOLD => 25000, STONE => 825, IRON => 675),
    	'requireLevel' => 111
    ),*/
    /*********************Civ Tab - End************************/
);
?>