<?php
require_once ROOT_APPLICATION_CONTROLLERS.DS.'BaseController.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'models'.DS.'Models_AwardType.php';
require_once ROOT_LIBRARY_UTILITY.DS.'utility.php';
require_once ROOT_APPLICATION_MODELS.DS.'Models_Log.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'object'.DS.'Obj_AwardType.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'campaign'.DS.'form'.DS.'Forms_AwardType.php';

require_once ROOT_APPLICATION.DS.'modules'.DS.'localize'.DS.'models'.DS.'Models_String.php';
require_once ROOT_APPLICATION.DS.'modules'.DS.'localize'.DS.'models'.DS.'Models_Export.php';

class Compensation_CompensationController extends BaseController
{
	public function _setUserPrivileges()
	{
		return array('index','add','edit','update','delete');
	}
	public function preDispatch()
	{
		parent::preDispatch();
		if(!$this->hasPrivilege())
			$this->_redirect ("/error/permission");
	}
	public function indexAction()
	{
		
	}
	public function index2Action()
	{
		
	}
	public function getdataAction()
	{
		try{
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender();
			$json = '{
	"membase1": {
		"level_860": 10,
		"energy_860": {
			"energy": 4.4533333333333,
			"lastRestored": 1334743904
		},
		"friendList_860": {
			"127759": {
				"fid": 127759,
				"fullname": "L\u00ea Nguy\u1ec5n",
				"avatar": "http:\/\/a.1.s50.avatar.zdn.vn\/avatar_files\/a\/b\/a\/6\/lynncoi_50_186.jpg",
				"level": 10
			},
			"437141": {
				"fid": 437141,
				"fullname": "Tr\u01b0\u01a1ng Danh Thanh T\u00fa",
				"avatar": "http:\/\/1.1.s50.avatar.zdn.vn\/avatar_files\/1\/b\/d\/9\/alexzhang1107_50_17.jpg",
				"level": 30
			},
			"20655643": {
				"fid": 20655643,
				"fullname": "Bill B\u00f4ng B\u1ee5p",
				"avatar": "http:\/\/3.1.s50.avatar.zdn.vn\/avatar_files\/3\/7\/3\/3\/billga85_50_34.jpg",
				"level": 16
			}
		},
		"employees_860": false,
		"fanfare_860": false,
		"gold_860": 3434,
		"coin_860": 136,
		"wood_860": 557,
		"iron_860": 567,
		"stone_860": 520,
		"honour_860": 589,
		"civ_860": 393,
		"user_860": {
			"id": 860,
			"username": "tester198",
			"fullName": "T\u00fa Uy\u00ean",
			"avatar": "http:\/\/3.1.s50.avatar.zdn.vn\/avatar_files\/3\/2\/6\/3\/tester198_50_9.jpg",
			"created": 1334600188,
			"isBeginner": false,
			"lastLogin": 1334806537
		},
		"mapCollection_860": {
			"1": "mapCollection_4f8c61fe3ba80"
		},
		"mapBattleCollection_860": {
			"1": "mapBattleCollection_4f8c61fe3b310",
			"1001": "mapBattleCollection_4f8c61fe3bec4"
		},
		"popCollection_860": {
			"1": "popCollection_4f8c61fe3c66c"
		},
		"unlockLayouts_860": {
			"1": null,
			"2": null,
			"3": null,
			"4": null,
			"5": null
		},
		"battleCollection_860": {
			"battle_4f8c660c4efba": "battleCollection_4f8c660c4f349",
			"battle_4f8c661db209d": "battleCollection_4f8c661db246a",
			"battle_4f8c662c15b4f": "battleCollection_4f8c662c15f27",
			"battle_4f8c663c114bf": "battleCollection_4f8c663c118c1",
			"battle_4f8c6653abc65": "battleCollection_4f8c6653ac027",
			"battle_4f8cef783aa02": "battleCollection_4f8cef783b190",
			"battle_4f8d0ff330017": "battleCollection_4f8d0ff330443",
			"battle_4f8d10620ead5": "battleCollection_4f8d10620ef38",
			"battle_4f8dbba61e105": "battleCollection_4f8dbba61e4d0"
		},
		"shop_860": {
			"unlockedItems": [],
			"blockQuantity": 2,
			"upgradeSoldier": []
		},
		"friend_860": {
			"helpedList": {
				"1_BuildingProduction_2002_4f7d709d7b2d5": null,
				"1_BuildingProduction_2002_4f8d7a3fd2194": null,
				"1_BuildingProduction_2002_4f8d7a4aeaafe": null,
				"1_BuildingProduction_2002_4f7d70984154f": null,
				"1_BuildingProduction_2002_4f7d28e5b1887": null,
				"1_BuildingProduction_2002_4f83d4c51b56f": null,
				"1_BuildingProduction_2002_4f83dcd404d99": null,
				"1_BuildingProduction_2002_4f87a623d9619": null,
				"1_BuildingProduction_2002_4f87a61fd1d9a": null,
				"1_BuildingProduction_2002_4f83d55e39194": null
			},
			"energyList": {
				"437141": 0,
				"20655643": 0
			},
			"nextReset": 1334725200
		},
		"quest_860": {
			"finishList": {
				"13": 1334600271,
				"14": 1334600488,
				"76": 1334600498,
				"39": 1334600792,
				"15": 1334600845,
				"78": 1334600968,
				"77": 1334601000,
				"94": 1334601017,
				"90": 1334601081,
				"16": 1334601199,
				"40": 1334636189,
				"91": 1334636389,
				"41": 1334654019,
				"98": 1334686907,
				"17": 1334688631,
				"42": 1334691118,
				"24": 1334716841,
				"43": 1334731521,
				"44": 1334740721
			},
			"activeList": {
				"80": {
					"133": {
						"action": 4005,
						"target": 1001,
						"quantity": 1
					}
				},
				"100": {
					"164": {
						"action": 4001,
						"target": null,
						"quantity": -5
					},
					"165": {
						"action": 10,
						"target": 2002,
						"quantity": 3
					}
				},
				"45": {
					"90": {
						"action": 1002,
						"target": 5005,
						"quantity": 5
					}
				}
			}
		},
		"messageCollection_860": false,
		"mapCollection_4f8c61fe3ba80": {
			"id": 1,
			"name": "L\u00e0ng B\u00ed \u1ea8n",
			"unlockedBlocks": {
				"0": null,
				"1": null,
				"5": null,
				"6": null,
				"10": null,
				"11": null
			},
			"buildingQuantities": {
				"2077": 3,
				"2003": 3,
				"2051": 16,
				"2050": 17,
				"2046": 12,
				"2066": 1,
				"2044": 26,
				"2049": 15,
				"2055": 2,
				"2045": 23,
				"2047": 11,
				"2053": 14,
				"2001": 3,
				"2054": 7,
				"2056": 5,
				"2036": 1,
				"2023": 23,
				"2074": 1,
				"2022": 1,
				"2004": 9,
				"2048": 4,
				"2033": 1,
				"2072": 2,
				"2002": 7,
				"2019": 1,
				"2081": 1,
				"2082": 1,
				"2020": 3,
				"2076": 3
			}
		},
		"mapBattleCollection_4f8c61fe3b310": {
			"id": 1,
			"openedBattles": true
		},
		"mapBattleCollection_4f8c61fe3bec4": {
			"id": 1001,
			"openedBattles": [1,
			2,
			3,
			4,
			5]
		},
		"popCollection_4f8c61fe3c66c": {
			"id": 1,
			"maxPop": 12,
			"curPop": 12,
			"curWorker": 9,
			"busyWorker": 7
		},
		"battleCollection_4f8c660c4f349": {
			"id": "battle_4f8c660c4efba",
			"result": 1,
			"attack": {
				"1": "1_SoldierNormal_9043_1_4f8c65cdf049d",
				"3": "1_SoldierCol_9022_1_4f8c655cd0e97",
				"5": "1_SoldierNormal_9001_1_4f8c65102212f"
			},
			"defend": ["1_SoldierAll_15036_1_4f8c660c46dfb"],
			"turn": [{
				"att": "1_SoldierNormal_9043_1_4f8c65cdf049d",
				"defs": {
					"1_SoldierAll_15036_1_4f8c660c46dfb": {
						"lostHP": 15,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierAll_15036_1_4f8c660c46dfb",
				"defs": {
					"1_SoldierNormal_9043_1_4f8c65cdf049d": {
						"lostHP": 13,
						"critical": false
					},
					"1_SoldierCol_9022_1_4f8c655cd0e97": {
						"lostHP": 7,
						"critical": false
					},
					"1_SoldierNormal_9001_1_4f8c65102212f": {
						"lostHP": 10,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierCol_9022_1_4f8c655cd0e97",
				"defs": {
					"1_SoldierAll_15036_1_4f8c660c46dfb": {
						"lostHP": 15,
						"critical": false
					}
				}
			}],
			"createDate": 1334601228,
			"type": 1,
			"invadeType": 2,
			"mapId": 1001
		},
		"battleCollection_4f8c661db246a": {
			"id": "battle_4f8c661db209d",
			"result": 1,
			"attack": {
				"2": "1_SoldierNormal_9043_1_4f8c65cdf049d",
				"3": "1_SoldierCol_9022_1_4f8c655cd0e97",
				"4": "1_SoldierNormal_9001_1_4f8c65102212f"
			},
			"defend": ["1_SoldierNormal_15025_1_4f8c661da9f7f"],
			"turn": [{
				"att": "1_SoldierNormal_9043_1_4f8c65cdf049d",
				"defs": {
					"1_SoldierNormal_15025_1_4f8c661da9f7f": {
						"lostHP": 14,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_15025_1_4f8c661da9f7f",
				"defs": {
					"1_SoldierCol_9022_1_4f8c655cd0e97": {
						"lostHP": 17,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierCol_9022_1_4f8c655cd0e97",
				"defs": {
					"1_SoldierNormal_15025_1_4f8c661da9f7f": {
						"lostHP": 14,
						"critical": false
					}
				}
			}],
			"createDate": 1334601245,
			"type": 2,
			"invadeType": 2,
			"mapId": 1001
		},
		"battleCollection_4f8c662c15f27": {
			"id": "battle_4f8c662c15b4f",
			"result": 1,
			"attack": {
				"2": "1_SoldierNormal_9043_1_4f8c65cdf049d",
				"3": "1_SoldierNormal_9001_1_4f8c65102212f",
				"4": "1_SoldierCol_9022_1_4f8c655cd0e97"
			},
			"defend": {
				"1": "1_SoldierNormal_15019_1_4f8c662c0de77"
			},
			"turn": [{
				"att": "1_SoldierNormal_9043_1_4f8c65cdf049d",
				"defs": {
					"1_SoldierNormal_15019_1_4f8c662c0de77": {
						"lostHP": 20,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_15019_1_4f8c662c0de77",
				"defs": {
					"1_SoldierCol_9022_1_4f8c655cd0e97": {
						"lostHP": 6,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_9001_1_4f8c65102212f",
				"defs": {
					"1_SoldierNormal_15019_1_4f8c662c0de77": {
						"lostHP": 30,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierCol_9022_1_4f8c655cd0e97",
				"defs": {
					"1_SoldierNormal_15019_1_4f8c662c0de77": {
						"lostHP": 15,
						"critical": false
					}
				}
			}],
			"createDate": 1334601259,
			"type": 3,
			"invadeType": 2,
			"mapId": 1001
		},
		"battleCollection_4f8c663c118c1": {
			"id": "battle_4f8c663c114bf",
			"result": 1,
			"attack": {
				"2": "1_SoldierNormal_9001_1_4f8c65102212f",
				"3": "1_SoldierCol_9022_1_4f8c655cd0e97",
				"4": "1_SoldierNormal_9043_1_4f8c65cdf049d"
			},
			"defend": {
				"2": "1_SoldierNormal_15030_1_4f8c663c016cd",
				"3": "1_SoldierNormal_15005_1_4f8c663c097d1"
			},
			"turn": [{
				"att": "1_SoldierNormal_9001_1_4f8c65102212f",
				"defs": {
					"1_SoldierNormal_15030_1_4f8c663c016cd": {
						"lostHP": 24,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_15005_1_4f8c663c097d1",
				"defs": {
					"1_SoldierCol_9022_1_4f8c655cd0e97": {
						"lostHP": 10,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierCol_9022_1_4f8c655cd0e97",
				"defs": {
					"1_SoldierNormal_15005_1_4f8c663c097d1": {
						"lostHP": 6,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_9043_1_4f8c65cdf049d",
				"defs": {
					"1_SoldierNormal_15005_1_4f8c663c097d1": {
						"lostHP": 28,
						"critical": true
					}
				}
			},
			{
				"att": "1_SoldierNormal_15005_1_4f8c663c097d1",
				"defs": {
					"1_SoldierCol_9022_1_4f8c655cd0e97": {
						"lostHP": 10,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_9001_1_4f8c65102212f",
				"defs": {
					"1_SoldierNormal_15005_1_4f8c663c097d1": {
						"lostHP": 14,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierCol_9022_1_4f8c655cd0e97",
				"defs": {
					"1_SoldierNormal_15005_1_4f8c663c097d1": {
						"lostHP": 7,
						"critical": false
					}
				}
			}],
			"createDate": 1334601275,
			"type": 4,
			"invadeType": 2,
			"mapId": 1001
		},
		"battleCollection_4f8c6653ac027": {
			"id": "battle_4f8c6653abc65",
			"result": 1,
			"attack": {
				"2": "1_SoldierNormal_9001_1_4f8c65102212f",
				"3": "1_SoldierCol_9022_1_4f8c655cd0e97",
				"4": "1_SoldierNormal_9043_1_4f8c65cdf049d"
			},
			"defend": {
				"2": "1_SoldierNormal_15005_1_4f8c66539c1a9",
				"3": "1_SoldierCol_15011_1_4f8c6653a4366"
			},
			"turn": [{
				"att": "1_SoldierNormal_9001_1_4f8c65102212f",
				"defs": {
					"1_SoldierNormal_15005_1_4f8c66539c1a9": {
						"lostHP": 14,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_15005_1_4f8c66539c1a9",
				"defs": {
					"1_SoldierNormal_9001_1_4f8c65102212f": {
						"lostHP": 6,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierCol_9022_1_4f8c655cd0e97",
				"defs": {
					"1_SoldierCol_15011_1_4f8c6653a4366": {
						"lostHP": 9,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierCol_15011_1_4f8c6653a4366",
				"defs": {
					"1_SoldierCol_9022_1_4f8c655cd0e97": {
						"lostHP": 10,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_9043_1_4f8c65cdf049d",
				"defs": {
					"1_SoldierCol_15011_1_4f8c6653a4366": {
						"lostHP": 20,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_15005_1_4f8c66539c1a9",
				"defs": {
					"1_SoldierNormal_9001_1_4f8c65102212f": {
						"lostHP": 6,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_9001_1_4f8c65102212f",
				"defs": {
					"1_SoldierNormal_15005_1_4f8c66539c1a9": {
						"lostHP": 14,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierCol_15011_1_4f8c6653a4366",
				"defs": {
					"1_SoldierCol_9022_1_4f8c655cd0e97": {
						"lostHP": 10,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierCol_9022_1_4f8c655cd0e97",
				"defs": {
					"1_SoldierCol_15011_1_4f8c6653a4366": {
						"lostHP": 9,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_9043_1_4f8c65cdf049d",
				"defs": {
					"1_SoldierCol_15011_1_4f8c6653a4366": {
						"lostHP": 21,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_15005_1_4f8c66539c1a9",
				"defs": {
					"1_SoldierNormal_9001_1_4f8c65102212f": {
						"lostHP": 5,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierCol_9022_1_4f8c655cd0e97",
				"defs": {
					"1_SoldierNormal_15005_1_4f8c66539c1a9": {
						"lostHP": 6,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_9043_1_4f8c65cdf049d",
				"defs": {
					"1_SoldierNormal_15005_1_4f8c66539c1a9": {
						"lostHP": 0,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_15005_1_4f8c66539c1a9",
				"defs": {
					"1_SoldierNormal_9043_1_4f8c65cdf049d": {
						"lostHP": 22,
						"critical": true
					}
				}
			},
			{
				"att": "1_SoldierCol_9022_1_4f8c655cd0e97",
				"defs": {
					"1_SoldierNormal_15005_1_4f8c66539c1a9": {
						"lostHP": 6,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_9043_1_4f8c65cdf049d",
				"defs": {
					"1_SoldierNormal_15005_1_4f8c66539c1a9": {
						"lostHP": 18,
						"critical": false
					}
				}
			}],
			"createDate": 1334601299,
			"type": 5,
			"invadeType": 2,
			"mapId": 1001
		},
		"battleCollection_4f8cef783b190": {
			"id": "battle_4f8cef783aa02",
			"result": -1,
			"attack": {
				"2": "1_SoldierCol_9022_1_4f8c655cd0e97",
				"3": "1_SoldierNormal_9043_1_4f8cef4d69dfb",
				"4": "1_SoldierNormal_9043_1_4f8c65cdf049d"
			},
			"defend": {
				"1": "1_SoldierNormal_15005_1_4f8cef782333d",
				"3": "1_SoldierNormal_15007_1_4f8cef782b3ce",
				"4": "1_SoldierNormal_15004_1_4f8cef78330ea"
			},
			"turn": [{
				"att": "1_SoldierCol_9022_1_4f8c655cd0e97",
				"defs": {
					"1_SoldierNormal_15005_1_4f8cef782333d": {
						"lostHP": 7,
						"critical": false
					},
					"1_SoldierNormal_15004_1_4f8cef78330ea": {
						"lostHP": 12,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_15005_1_4f8cef782333d",
				"defs": {
					"1_SoldierNormal_9043_1_4f8c65cdf049d": {
						"lostHP": 11,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_9043_1_4f8cef4d69dfb",
				"defs": {
					"1_SoldierNormal_15007_1_4f8cef782b3ce": {
						"lostHP": 26,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_15007_1_4f8cef782b3ce",
				"defs": {
					"1_SoldierNormal_9043_1_4f8cef4d69dfb": {
						"lostHP": 21,
						"critical": true
					}
				}
			},
			{
				"att": "1_SoldierNormal_9043_1_4f8c65cdf049d",
				"defs": {
					"1_SoldierNormal_15005_1_4f8cef782333d": {
						"lostHP": 18,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_15004_1_4f8cef78330ea",
				"defs": {
					"1_SoldierNormal_9043_1_4f8c65cdf049d": {
						"lostHP": 15,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierCol_9022_1_4f8c655cd0e97",
				"defs": {
					"1_SoldierNormal_15005_1_4f8cef782333d": {
						"lostHP": 0,
						"critical": false
					},
					"1_SoldierNormal_15004_1_4f8cef78330ea": {
						"lostHP": 13,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_15005_1_4f8cef782333d",
				"defs": {
					"1_SoldierNormal_9043_1_4f8c65cdf049d": {
						"lostHP": 12,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_9043_1_4f8cef4d69dfb",
				"defs": {
					"1_SoldierNormal_15007_1_4f8cef782b3ce": {
						"lostHP": 26,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_15007_1_4f8cef782b3ce",
				"defs": {
					"1_SoldierNormal_9043_1_4f8cef4d69dfb": {
						"lostHP": 12,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_9043_1_4f8c65cdf049d",
				"defs": {
					"1_SoldierNormal_15005_1_4f8cef782333d": {
						"lostHP": 17,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_15004_1_4f8cef78330ea",
				"defs": {
					"1_SoldierNormal_9043_1_4f8c65cdf049d": {
						"lostHP": 15,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierCol_9022_1_4f8c655cd0e97",
				"defs": {
					"1_SoldierNormal_15005_1_4f8cef782333d": {
						"lostHP": 7,
						"critical": false
					},
					"1_SoldierNormal_15004_1_4f8cef78330ea": {
						"lostHP": 13,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_15005_1_4f8cef782333d",
				"defs": {
					"1_SoldierNormal_9043_1_4f8cef4d69dfb": {
						"lostHP": 11,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_9043_1_4f8cef4d69dfb",
				"defs": {
					"1_SoldierNormal_15007_1_4f8cef782b3ce": {
						"lostHP": 0,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_15007_1_4f8cef782b3ce",
				"defs": {
					"1_SoldierNormal_9043_1_4f8cef4d69dfb": {
						"lostHP": 12,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_15004_1_4f8cef78330ea",
				"defs": {
					"1_SoldierCol_9022_1_4f8c655cd0e97": {
						"lostHP": 14,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierCol_9022_1_4f8c655cd0e97",
				"defs": {
					"1_SoldierNormal_15005_1_4f8cef782333d": {
						"lostHP": 12,
						"critical": true
					},
					"1_SoldierNormal_15004_1_4f8cef78330ea": {
						"lostHP": 12,
						"critical": false
					}
				}
			},
			{
				"att": "1_SoldierNormal_15007_1_4f8cef782b3ce",
				"defs": {
					"1_SoldierCol_9022_1_4f8c655cd0e97": {
						"lostHP": 13,
						"critical": true
					}
				}
			},
			{
				"att": "1_SoldierNormal_15004_1_4f8cef78330ea",
				"defs": {
					"1_SoldierCol_9022_1_4f8c655cd0e97": {
						"lostHP": 13,
						"critical": false
					}
				}
			}],
			"createDate": 1334636407,
			"type": 6,
			"invadeType": 2,
			"mapId": 1001
		},
		"battleCollection_4f8d0ff330443": {
			"id": "battle_4f8d0ff330017",
			"result": 0,
			"attack": [],
			"defend": {
				"1": "1_SoldierNormal_15005_1_4f8d0ff3180ce",
				"3": "1_SoldierNormal_15007_1_4f8d0ff3205e6",
				"4": "1_SoldierNormal_15004_1_4f8d0ff328381"
			},
			"turn": [],
			"createDate": 1334644722,
			"type": 6,
			"invadeType": 2,
			"mapId": 1001
		},
		"battleCollection_4f8d10620ef38": {
			"id": "battle_4f8d10620ead5",
			"result": 0,
			"attack": [],
			"defend": {
				"1": "1_SoldierNormal_15005_1_4f8d1061eb6e6",
				"3": "1_SoldierNormal_15007_1_4f8d1061f3730",
				"4": "1_SoldierNormal_15004_1_4f8d106206de1"
			},
			"turn": [],
			"createDate": 1334644833,
			"type": 6,
			"invadeType": 2,
			"mapId": 1001
		},
		"battleCollection_4f8dbba61e4d0": {
			"id": "battle_4f8dbba61e105",
			"result": 0,
			"attack": [],
			"defend": {
				"1": "1_SoldierNormal_15005_1_4f8dbba605602",
				"3": "1_SoldierNormal_15007_1_4f8dbba60db04",
				"4": "1_SoldierNormal_15004_1_4f8dbba615bab"
			},
			"turn": [],
			"createDate": 1334688677,
			"type": 6,
			"invadeType": 2,
			"mapId": 1001
		}
	},
	"memcache1": {
		"session2_860": {
			"session": "1F018988821E59FAEE6910D3",
			"sound": true,
			"music": true
		}
	},
	"membase2": {
		"buildingCollection_860": {
			"1_BuildingProduction_2077_4f8c61fe3d25d": "buildingCollection_4f8c61fe3d61f",
			"1_BuildingProduction_2003_4f8c61fe3d9bb": "buildingCollection_4f8c61fe3dd9f",
			"1_BuildingNature_2051_4f8c61fe3e18c": "buildingCollection_4f8c61fe3e573",
			"1_BuildingNature_2050_4f8c61fe3e958": "buildingCollection_4f8c61fe3ed46",
			"1_BuildingNature_2046_4f8c61fe3f12a": "buildingCollection_4f8c61fe3f514",
			"1_BuildingDecor_2066_4f8c61fe3f97d": "buildingCollection_4f8c61fe3fda0",
			"1_BuildingNature_2044_4f8c61fe40144": "buildingCollection_4f8c61fe404ef",
			"1_BuildingNature_2050_4f8c61fe4097a": "buildingCollection_4f8c61fe40d0e",
			"1_BuildingNature_2049_4f8c61fe41096": "buildingCollection_4f8c61fe414d7",
			"1_BuildingNature_2055_4f8c61fe418d0": "buildingCollection_4f8c61fe41d04",
			"1_BuildingNature_2045_4f8c61fe42080": "buildingCollection_4f8c61fe42432",
			"1_BuildingNature_2050_4f8c61fe427fd": "buildingCollection_4f8c61fe42c37",
			"1_BuildingNature_2044_4f8c61fe43019": "buildingCollection_4f8c61fe433ea",
			"1_BuildingNature_2045_4f8c61fe43817": "buildingCollection_4f8c61fe43b87",
			"1_BuildingNature_2045_4f8c61fe43f49": "buildingCollection_4f8c61fe44399",
			"1_BuildingNature_2044_4f8c61fe4474e": "buildingCollection_4f8c61fe44b88",
			"1_BuildingNature_2050_4f8c61fe44eec": "buildingCollection_4f8c61fe452d1",
			"1_BuildingNature_2044_4f8c61fe456b4": "buildingCollection_4f8c61fe45a9e",
			"1_BuildingNature_2047_4f8c61fe45e9e": "buildingCollection_4f8c61fe46270",
			"1_BuildingNature_2053_4f8c61fe4668b": "buildingCollection_4f8c61fe46ae0",
			"1_BuildingNature_2044_4f8c61fe46ebd": "buildingCollection_4f8c61fe4729d",
			"1_BuildingProduction_2077_4f8c61fe4761e": "buildingCollection_4f8c61fe47ab2",
			"1_BuildingNature_2053_4f8c61fe47e43": "buildingCollection_4f8c61fe481ff",
			"1_BuildingNature_2044_4f8c61fe48598": "buildingCollection_4f8c61fe48980",
			"1_BuildingNature_2045_4f8c61fe48e44": "buildingCollection_4f8c61fe49183",
			"1_BuildingNature_2045_4f8c61fe49565": "buildingCollection_4f8c61fe49926",
			"1_BuildingNature_2051_4f8c61fe49d06": "buildingCollection_4f8c61fe4a0f1",
			"1_BuildingProduction_2001_4f8c61fe4a4d8": "buildingCollection_4f8c61fe4a8bd",
			"1_BuildingNature_2045_4f8c61fe4aca6": "buildingCollection_4f8c61fe4b092",
			"1_BuildingNature_2050_4f8c61fe4b531": "buildingCollection_4f8c61fe4b8fc",
			"1_BuildingNature_2051_4f8c61fe4bcd4": "buildingCollection_4f8c61fe4c092",
			"1_BuildingNature_2051_4f8c61fe4c4c9": "buildingCollection_4f8c61fe4c8ba",
			"1_BuildingNature_2051_4f8c61fe4cc37": "buildingCollection_4f8c61fe4cfd2",
			"1_BuildingNature_2051_4f8c61fe4d3b8": "buildingCollection_4f8c61fe4d7a1",
			"1_BuildingNature_2044_4f8c61fe4db87": "buildingCollection_4f8c61fe4dff5",
			"1_BuildingNature_2050_4f8c61fe4e35d": "buildingCollection_4f8c61fe4e73e",
			"1_BuildingNature_2049_4f8c61fe4eb27": "buildingCollection_4f8c61fe4ef44",
			"1_BuildingNature_2044_4f8c61fe4f31a": "buildingCollection_4f8c61fe4f6e2",
			"1_BuildingNature_2049_4f8c61fe4fac8": "buildingCollection_4f8c61fe4feb1",
			"1_BuildingNature_2051_4f8c61fe50337": "buildingCollection_4f8c61fe5073a",
			"1_BuildingNature_2049_4f8c61fe50aa4": "buildingCollection_4f8c61fe50e97",
			"1_BuildingNature_2049_4f8c61fe51270": "buildingCollection_4f8c61fe516b0",
			"1_BuildingNature_2049_4f8c61fe51a37": "buildingCollection_4f8c61fe51df0",
			"1_BuildingNature_2045_4f8c61fe521d7": "buildingCollection_4f8c61fe52661",
			"1_BuildingNature_2053_4f8c61fe529d4": "buildingCollection_4f8c61fe52e1c",
			"1_BuildingNature_2047_4f8c61fe53180": "buildingCollection_4f8c61fe5355f",
			"1_BuildingNature_2047_4f8c61fe539dd": "buildingCollection_4f8c61fe53d9f",
			"1_BuildingNature_2054_4f8c61fe54167": "buildingCollection_4f8c61fe5457f",
			"1_BuildingNature_2051_4f8c61fe5493a": "buildingCollection_4f8c61fe54cda",
			"1_BuildingNature_2044_4f8c61fe550b6": "buildingCollection_4f8c61fe5549f",
			"1_BuildingProduction_2003_4f8c61fe55889": "buildingCollection_4f8c61fe55c6f",
			"1_BuildingNature_2054_4f8c61fe5608d": "buildingCollection_4f8c61fe564ef",
			"1_BuildingNature_2051_4f8c61fe57085": "buildingCollection_4f8c61fe5742e",
			"1_BuildingNature_2051_4f8c61fe57f98": "buildingCollection_4f8c61fe583a4",
			"1_BuildingNature_2053_4f8c61fe587c9": "buildingCollection_4f8c61fe58b53",
			"1_BuildingNature_2053_4f8c61fe58fd6": "buildingCollection_4f8c61fe5939c",
			"1_BuildingNature_2044_4f8c61fe597c2": "buildingCollection_4f8c61fe59b98",
			"1_BuildingNature_2044_4f8c61fe59ef7": "buildingCollection_4f8c61fe5a2be",
			"1_BuildingNature_2044_4f8c61fe5a6a6": "buildingCollection_4f8c61fe5aaf7",
			"1_BuildingNature_2050_4f8c61fe5ae9a": "buildingCollection_4f8c61fe5b30c",
			"1_BuildingNature_2049_4f8c61fe5b6fb": "buildingCollection_4f8c61fe5ba5c",
			"1_BuildingNature_2054_4f8c61fe5be4f": "buildingCollection_4f8c61fe5c2aa",
			"1_BuildingNature_2050_4f8c61fe5c680": "buildingCollection_4f8c61fe5ca75",
			"1_BuildingNature_2045_4f8c61fe5ce6c": "buildingCollection_4f8c61fe5d25e",
			"1_BuildingProduction_2001_4f8c61fe5d5a9": "buildingCollection_4f8c61fe5d994",
			"1_BuildingNature_2044_4f8c61fe5dd62": "buildingCollection_4f8c61fe5e133",
			"1_BuildingNature_2049_4f8c61fe5e54a": "buildingCollection_4f8c61fe5e9cb",
			"1_BuildingNature_2044_4f8c61fe5ecff": "buildingCollection_4f8c61fe5f0dc",
			"1_BuildingNature_2051_4f8c61fe5fd3c": "buildingCollection_4f8c61fe600f2",
			"1_BuildingNature_2045_4f8c61fe604ad": "buildingCollection_4f8c61fe60851",
			"1_BuildingNature_2044_4f8c61fe60cf3": "buildingCollection_4f8c61fe610ce",
			"1_BuildingNature_2045_4f8c61fe61408": "buildingCollection_4f8c61fe617ef",
			"1_BuildingNature_2056_4f8c61fe61bd5": "buildingCollection_4f8c61fe62073",
			"1_BuildingNature_2051_4f8c61fe623dd": "buildingCollection_4f8c61fe62790",
			"1_BuildingNature_2044_4f8c61fe62b78": "buildingCollection_4f8c61fe62f5f",
			"1_BuildingNature_2044_4f8c61fe63346": "buildingCollection_4f8c61fe63787",
			"1_BuildingNature_2054_4f8c61fe63b3f": "buildingCollection_4f8c61fe63eff",
			"1_BuildingNature_2050_4f8c61fe642e8": "buildingCollection_4f8c61fe6478d",
			"1_BuildingNature_2045_4f8c61fe6533d": "buildingCollection_4f8c61fe656a5",
			"1_BuildingNature_2050_4f8c61fe662bc": "buildingCollection_4f8c61fe66611",
			"1_BuildingNature_2044_4f8c61fe669f5": "buildingCollection_4f8c61fe66e14",
			"1_BuildingNature_2044_4f8c61fe671e9": "buildingCollection_4f8c61fe675af",
			"1_BuildingNature_2056_4f8c61fe67994": "buildingCollection_4f8c61fe67d85",
			"1_BuildingNature_2051_4f8c61fe68167": "buildingCollection_4f8c61fe685ce",
			"1_BuildingNature_2054_4f8c61fe689b4": "buildingCollection_4f8c61fe68da5",
			"1_BuildingNature_2056_4f8c61fe69151": "buildingCollection_4f8c61fe69564",
			"1_BuildingDecor_2036_4f8c61fe69953": "buildingCollection_4f8c61fe69d00",
			"1_BuildingNature_2045_4f8c61fe6a0cb": "buildingCollection_4f8c61fe6a4f3",
			"1_BuildingNature_2054_4f8c61fe6a89f": "buildingCollection_4f8c61fe6ac5d",
			"1_BuildingNature_2045_4f8c61fe6b8ae": "buildingCollection_4f8c61fe6bcd0",
			"1_BuildingNature_2056_4f8c61fe6c063": "buildingCollection_4f8c61fe6c47c",
			"1_BuildingNature_2050_4f8c61fe6d042": "buildingCollection_4f8c61fe6d423",
			"1_BuildingNature_2053_4f8c61fe6df97": "buildingCollection_4f8c61fe6e42c",
			"1_BuildingNature_2049_4f8c61fe6e6fa": "buildingCollection_4f8c61fe6eb80",
			"1_BuildingNature_2056_4f8c61fe6ef23": "buildingCollection_4f8c61fe6f2d5",
			"1_BuildingDecor_2023_4f8c61fe6f693": "buildingCollection_4f8c61fe6fb1e",
			"1_BuildingNature_2053_4f8c61fe6fed8": "buildingCollection_4f8c61fe702d8",
			"1_BuildingNature_2045_4f8c61fe706c0": "buildingCollection_4f8c61fe70a26",
			"1_BuildingProduction_2001_4f8c61fe70e6e": "buildingCollection_4f8c61fe71256",
			"1_BuildingNature_2053_4f8c61fe715d8": "buildingCollection_4f8c61fe71a2f",
			"1_BuildingDecor_2023_4f8c61fe71e37": "buildingCollection_4f8c61fe72219",
			"1_BuildingNature_2045_4f8c61fe725de": "buildingCollection_4f8c61fe72a17",
			"1_BuildingNature_2053_4f8c61fe7351c": "buildingCollection_4f8c61fe738fb",
			"1_BuildingNature_2051_4f8c61fe73d85": "buildingCollection_4f8c61fe7417f",
			"1_BuildingDecor_2023_4f8c61fe74530": "buildingCollection_4f8c61fe7489f",
			"1_BuildingNature_2044_4f8c61fe74c88": "buildingCollection_4f8c61fe750f9",
			"1_BuildingNature_2053_4f8c61fe7641f": "buildingCollection_4f8c61fe767dd",
			"1_BuildingNature_2049_4f8c61fe76bc5": "buildingCollection_4f8c61fe76fb0",
			"1_BuildingDecor_2074_4f8c61fe77427": "buildingCollection_4f8c61fe77809",
			"1_BuildingDecor_2023_4f8c61fe77c09": "buildingCollection_4f8c61fe77fdb",
			"1_BuildingDecor_2023_4f8c61fe783dd": "buildingCollection_4f8c61fe78724",
			"1_BuildingDecor_2023_4f8c61fe78b61": "buildingCollection_4f8c61fe78f9f",
			"1_BuildingDecor_2023_4f8c61fe7936e": "buildingCollection_4f8c61fe79735",
			"1_BuildingDecor_2023_4f8c61fe79b04": "buildingCollection_4f8c61fe79eb5",
			"1_BuildingDecor_2023_4f8c61fe7a275": "buildingCollection_4f8c61fe7a65d",
			"1_BuildingDecor_2023_4f8c61fe7aa46": "buildingCollection_4f8c61fe7ae31",
			"1_BuildingDecor_2023_4f8c61fe7b2ad": "buildingCollection_4f8c61fe7b64f",
			"1_BuildingDecor_2022_4f8c61fe7ba81": "buildingCollection_4f8c61fe7bdd6",
			"1_BuildingNature_2044_4f8c61fe7c9e1": "buildingCollection_4f8c61fe7cdf2",
			"1_BuildingNature_2045_4f8c61fe7d1be": "buildingCollection_4f8c61fe7d5f8",
			"1_BuildingNature_2045_4f8c61fe7d9ad": "buildingCollection_4f8c61fe7dd68",
			"1_BuildingNature_2045_4f8c61fe7e0f4": "buildingCollection_4f8c61fe7e4e5",
			"1_BuildingNature_2045_4f8c61fe7e97a": "buildingCollection_4f8c61fe7ed38",
			"1_BuildingDecor_2023_4f8c61fe7f0db": "buildingCollection_4f8c61fe7f4a8",
			"1_BuildingHouse_2004_4f8c61fe7f910": "buildingCollection_4f8c61fe7fcc5",
			"1_BuildingNature_2048_4f8c61fe800c1": "buildingCollection_4f8c61fe80425",
			"1_BuildingNature_2047_4f8c61fe808ed": "buildingCollection_4f8c61fe80c18",
			"1_BuildingNature_2047_4f8c61fe80fd8": "buildingCollection_4f8c61fe813ff",
			"1_BuildingDecor_2023_4f8c61fe817a7": "buildingCollection_4f8c61fe81c22",
			"1_BuildingDecor_2023_4f8c61fe81f9b": "buildingCollection_4f8c61fe823b6",
			"1_BuildingNature_2050_4f8c61fe82770": "buildingCollection_4f8c61fe82b2e",
			"1_BuildingNature_2047_4f8c61fe82f15": "buildingCollection_4f8c61fe83301",
			"1_BuildingNature_2048_4f8c61fe836e8": "buildingCollection_4f8c61fe83ad0",
			"1_BuildingNature_2044_4f8c61fe83f30": "buildingCollection_4f8c61fe842bc",
			"1_BuildingNature_2046_4f8c61fe84725": "buildingCollection_4f8c61fe84aeb",
			"1_BuildingNature_2047_4f8c61fe84f0e": "buildingCollection_4f8c61fe852ec",
			"1_BuildingNature_2045_4f8c61fe85654": "buildingCollection_4f8c61fe85a8f",
			"1_BuildingDecor_2023_4f8c61fe85eb6": "buildingCollection_4f8c61fe8625c",
			"1_BuildingNature_2051_4f8c61fe875eb": "buildingCollection_4f8c61fe879f8",
			"1_BuildingNature_2053_4f8c61fe87dab": "buildingCollection_4f8c61fe8811b",
			"1_BuildingNature_2045_4f8c61fe88565": "buildingCollection_4f8c61fe88993",
			"1_BuildingNature_2044_4f8c61fe88d4d": "buildingCollection_4f8c61fe890ec",
			"1_BuildingHouse_2004_4f8c61fe8950c": "buildingCollection_4f8c61fe89921",
			"1_BuildingNature_2048_4f8c61fe89cba": "buildingCollection_4f8c61fe8a050",
			"1_BuildingNature_2044_4f8c61fe8ac18": "buildingCollection_4f8c61fe8b029",
			"1_BuildingNature_2045_4f8c61fe8b3e5": "buildingCollection_4f8c61fe8b7ce",
			"1_BuildingNature_2048_4f8c61fe8c384": "buildingCollection_4f8c61fe8c76c",
			"1_BuildingNature_2049_4f8c61fe8cbdf": "buildingCollection_4f8c61fe8cf5c",
			"1_BuildingNature_2053_4f8c61fe8d3d1": "buildingCollection_4f8c61fe8d73e",
			"1_BuildingDecor_2033_4f8c61fe8daf6": "buildingCollection_4f8c61fe8dedf",
			"1_BuildingHouse_2004_4f8c61fe8e2c4": "buildingCollection_4f8c61fe8e6b1",
			"1_BuildingNature_2044_4f8c61fe8ea93": "buildingCollection_4f8c61fe8ee7c",
			"1_BuildingDecor_2072_4f8c61fe8f266": "buildingCollection_4f8c61fe8f64e",
			"1_BuildingProduction_2003_4f8c61fe8fad5": "buildingCollection_4f8c61fe8fe20",
			"1_BuildingNature_2049_4f8c61fe90203": "buildingCollection_4f8c61fe9068a",
			"1_BuildingNature_2044_4f8c61fe90a67": "buildingCollection_4f8c61fe90e85",
			"1_BuildingNature_2053_4f8c61fe91273": "buildingCollection_4f8c61fe915b9",
			"1_BuildingHouse_2004_4f8c61fe919ec": "buildingCollection_4f8c61fe91e0c",
			"1_BuildingHouse_2004_4f8c61fe9218d": "buildingCollection_4f8c61fe9252c",
			"1_BuildingProduction_2077_4f8c61fe92913": "buildingCollection_4f8c61fe92d7b",
			"1_BuildingDecor_2072_4f8c61fe93806": "buildingCollection_4f8c61fe93d3f",
			"1_BuildingProduction_2002_4f8c61fe94158": "buildingCollection_4f8c61fe944fb",
			"1_BuildingNature_2045_4f8c61fe9540d": "buildingCollection_4f8c61fe957f3",
			"1_BuildingNature_2046_4f8c61fe95c11": "buildingCollection_4f8c61fe9600e",
			"1_BuildingNature_2050_4f8c61fe9645d": "buildingCollection_4f8c61fe96813",
			"1_BuildingNature_2054_4f8c61fe96c47": "buildingCollection_4f8c61fe96f65",
			"1_BuildingNature_2050_4f8c61fe9734c": "buildingCollection_4f8c61fe97734",
			"1_BuildingNature_2050_4f8c61fe982f0": "buildingCollection_4f8c61fe986d2",
			"1_BuildingNature_2046_4f8c61fe99339": "buildingCollection_4f8c61fe99673",
			"1_BuildingNature_2046_4f8c61fe9a2f0": "buildingCollection_4f8c61fe9a65d",
			"1_BuildingProduction_2002_4f8c6232ef324": "buildingCollection_4f8c6232efb69",
			"1_BuildingProduction_2002_4f8c624c758f4": "buildingCollection_4f8c624c76024",
			"1_BuildingProduction_2002_4f8c62b21a2a9": "buildingCollection_4f8c62b21aa7f",
			"1_BuildingProduction_2002_4f8c62b8b9991": "buildingCollection_4f8c62b8ba100",
			"1_BuildingHouse_2004_4f8c64656d13d": "buildingCollection_4f8c64656d866",
			"1_BuildingProduction_2019_4f8c64cc884ee": "buildingCollection_4f8c64cc888d3",
			"1_BuildingProduction_2081_4f8c64dea9b56": "buildingCollection_4f8c64dea9fc7",
			"1_BuildingHouse_2004_4f8c6516ed2c0": "buildingCollection_4f8c6516ed744",
			"1_BuildingProduction_2082_4f8c659028bcb": "buildingCollection_4f8c6590293f1",
			"1_BuildingProduction_2002_4f8ceecad6ec1": "buildingCollection_4f8ceecad76b8",
			"1_BuildingHouse_2004_4f8cef0e1462e": "buildingCollection_4f8cef0e14a1c",
			"1_BuildingHouse_2004_4f8cef71e9f2c": "buildingCollection_4f8cef71ea319",
			"1_BuildingHouse_2020_4f8db65c27171": "buildingCollection_4f8db65c278cf",
			"1_BuildingProduction_2002_4f8db743c1e6f": "buildingCollection_4f8db743c29c1",
			"1_BuildingHouse_2020_4f8db74978a5a": "buildingCollection_4f8db749791a2",
			"1_BuildingCiv_2076_4f8dc744b1610": "buildingCollection_4f8dc744b19fb",
			"1_BuildingCiv_2076_4f8dc7d5e6a4f": "buildingCollection_4f8dc7d5e7247",
			"1_BuildingCiv_2076_4f8dc84b75fb1": "buildingCollection_4f8dc84b76391",
			"1_BuildingHouse_2020_4f8dc8ed1395e": "buildingCollection_4f8dc8ed13d3a",
			"1_BuildingDecor_2023_4f8e2b3064d8a": "buildingCollection_4f8e2b30655c9",
			"1_BuildingDecor_2023_4f8e2b316ab68": "buildingCollection_4f8e2b316b752",
			"1_BuildingDecor_2023_4f8e2b3246580": "buildingCollection_4f8e2b3246d9d",
			"1_BuildingDecor_2023_4f8e2b33071dd": "buildingCollection_4f8e2b33079a4",
			"1_BuildingDecor_2023_4f8e2b33a25a9": "buildingCollection_4f8e2b33a2d70",
			"1_BuildingDecor_2023_4f8e2b356be9a": "buildingCollection_4f8e2b356ca96",
			"1_BuildingDecor_2023_4f8e2b368ba0d": "buildingCollection_4f8e2b368c1ce",
			"1_BuildingDecor_2023_4f8e2b37994ac": "buildingCollection_4f8e2b379a127"
		},
		"itemCollection_860": {
			"1_ItemResource_7007_4f8e76943ddb3": "itemCollection_4f8e76943e18c",
			"1_ItemResource_5005_4f8e86fef2142": "itemCollection_4f8e86fef2503",
			"1_ItemResource_5005_4f8e86ffb7ba6": "itemCollection_4f8e86ffb7f66",
			"1_ItemResource_5005_4f8e87018c02d": "itemCollection_4f8e87018c4f0",
			"1_ItemResource_5005_4f8e8702a6ab2": "itemCollection_4f8e8702a6e46",
			"1_ItemResource_5005_4f8e8707d312a": "itemCollection_4f8e8707d3539",
			"1_ItemResource_5005_4f8e870921580": "itemCollection_4f8e8709218d9"
		},
		"soldierCollection_860": {
			"1_SoldierCol_9022_1_4f8d10010b94c": "soldierCollection_4f8d10010c0ca",
			"1_SoldierNormal_9001_1_4f8d100319c1d": "soldierCollection_4f8d10031a32e",
			"1_SoldierNormal_9043_1_4f8d1006ca802": "soldierCollection_4f8d1006cafa1"
		},
		"buildingCollection_4f8c61fe3d61f": {
			"id": "1_BuildingProduction_2077_4f8c61fe3d25d",
			"type": 2077,
			"createDate": 1334600188,
			"position": {
				"x": 6,
				"y": 36
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe3dd9f": {
			"id": "1_BuildingProduction_2003_4f8c61fe3d9bb",
			"type": 2003,
			"createDate": 1334600188,
			"position": {
				"x": 6,
				"y": 21
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe3e573": {
			"id": "1_BuildingNature_2051_4f8c61fe3e18c",
			"type": 2051,
			"createDate": 1334600188,
			"position": {
				"x": 6,
				"y": 10
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe3ed46": {
			"id": "1_BuildingNature_2050_4f8c61fe3e958",
			"type": 2050,
			"createDate": 1334600188,
			"position": {
				"x": 7,
				"y": 25
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe3f514": {
			"id": "1_BuildingNature_2046_4f8c61fe3f12a",
			"type": 2046,
			"createDate": 1334600188,
			"position": {
				"x": 7,
				"y": 39
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe3fda0": {
			"id": "1_BuildingDecor_2066_4f8c61fe3f97d",
			"type": 2066,
			"createDate": 1334600188,
			"position": {
				"x": 8,
				"y": 8
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe404ef": {
			"id": "1_BuildingNature_2044_4f8c61fe40144",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 8,
				"y": 15
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe40d0e": {
			"id": "1_BuildingNature_2050_4f8c61fe4097a",
			"type": 2050,
			"createDate": 1334600188,
			"position": {
				"x": 8,
				"y": 39
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe414d7": {
			"id": "1_BuildingNature_2049_4f8c61fe41096",
			"type": 2049,
			"createDate": 1334600188,
			"position": {
				"x": 9,
				"y": 1
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe41d04": {
			"id": "1_BuildingNature_2055_4f8c61fe418d0",
			"type": 2055,
			"createDate": 1334600188,
			"position": {
				"x": 9,
				"y": 18
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe42432": {
			"id": "1_BuildingNature_2045_4f8c61fe42080",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 9,
				"y": 28
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe42c37": {
			"id": "1_BuildingNature_2050_4f8c61fe427fd",
			"type": 2050,
			"createDate": 1334600188,
			"position": {
				"x": 9,
				"y": 6
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe433ea": {
			"id": "1_BuildingNature_2044_4f8c61fe43019",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 9,
				"y": 15
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe43b87": {
			"id": "1_BuildingNature_2045_4f8c61fe43817",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 10,
				"y": 13
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe44399": {
			"id": "1_BuildingNature_2045_4f8c61fe43f49",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 10,
				"y": 17
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe44b88": {
			"id": "1_BuildingNature_2044_4f8c61fe4474e",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 10,
				"y": 18
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe452d1": {
			"id": "1_BuildingNature_2050_4f8c61fe44eec",
			"type": 2050,
			"createDate": 1334600188,
			"position": {
				"x": 11,
				"y": 34
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe45a9e": {
			"id": "1_BuildingNature_2044_4f8c61fe456b4",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 11,
				"y": 13
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe46270": {
			"id": "1_BuildingNature_2047_4f8c61fe45e9e",
			"type": 2047,
			"createDate": 1334600188,
			"position": {
				"x": 11,
				"y": 37
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe46ae0": {
			"id": "1_BuildingNature_2053_4f8c61fe4668b",
			"type": 2053,
			"createDate": 1334600188,
			"position": {
				"x": 11,
				"y": 39
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe4729d": {
			"id": "1_BuildingNature_2044_4f8c61fe46ebd",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 12,
				"y": 18
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe47ab2": {
			"id": "1_BuildingProduction_2077_4f8c61fe4761e",
			"type": 2077,
			"createDate": 1334600188,
			"position": {
				"x": 12,
				"y": 19
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe481ff": {
			"id": "1_BuildingNature_2053_4f8c61fe47e43",
			"type": 2053,
			"createDate": 1334600188,
			"position": {
				"x": 12,
				"y": 21
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe48980": {
			"id": "1_BuildingNature_2044_4f8c61fe48598",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 12,
				"y": 13
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe49183": {
			"id": "1_BuildingNature_2045_4f8c61fe48e44",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 12,
				"y": 23
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe49926": {
			"id": "1_BuildingNature_2045_4f8c61fe49565",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 13,
				"y": 16
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe4a0f1": {
			"id": "1_BuildingNature_2051_4f8c61fe49d06",
			"type": 2051,
			"createDate": 1334600188,
			"position": {
				"x": 13,
				"y": 34
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe4a8bd": {
			"id": "1_BuildingProduction_2001_4f8c61fe4a4d8",
			"type": 2001,
			"createDate": 1334600188,
			"position": {
				"x": 13,
				"y": 10
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe4b092": {
			"id": "1_BuildingNature_2045_4f8c61fe4aca6",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 13,
				"y": 12
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe4b8fc": {
			"id": "1_BuildingNature_2050_4f8c61fe4b531",
			"type": 2050,
			"createDate": 1334600188,
			"position": {
				"x": 13,
				"y": 26
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe4c092": {
			"id": "1_BuildingNature_2051_4f8c61fe4bcd4",
			"type": 2051,
			"createDate": 1334600188,
			"position": {
				"x": 13,
				"y": 38
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe4c8ba": {
			"id": "1_BuildingNature_2051_4f8c61fe4c4c9",
			"type": 2051,
			"createDate": 1334600188,
			"position": {
				"x": 14,
				"y": 3
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe4cfd2": {
			"id": "1_BuildingNature_2051_4f8c61fe4cc37",
			"type": 2051,
			"createDate": 1334600188,
			"position": {
				"x": 14,
				"y": 20
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe4d7a1": {
			"id": "1_BuildingNature_2051_4f8c61fe4d3b8",
			"type": 2051,
			"createDate": 1334600188,
			"position": {
				"x": 14,
				"y": 6
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe4dff5": {
			"id": "1_BuildingNature_2044_4f8c61fe4db87",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 14,
				"y": 30
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe4e73e": {
			"id": "1_BuildingNature_2050_4f8c61fe4e35d",
			"type": 2050,
			"createDate": 1334600188,
			"position": {
				"x": 15,
				"y": 32
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe4ef44": {
			"id": "1_BuildingNature_2049_4f8c61fe4eb27",
			"type": 2049,
			"createDate": 1334600188,
			"position": {
				"x": 15,
				"y": 33
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe4f6e2": {
			"id": "1_BuildingNature_2044_4f8c61fe4f31a",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 15,
				"y": 16
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe4feb1": {
			"id": "1_BuildingNature_2049_4f8c61fe4fac8",
			"type": 2049,
			"createDate": 1334600188,
			"position": {
				"x": 15,
				"y": 0
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe5073a": {
			"id": "1_BuildingNature_2051_4f8c61fe50337",
			"type": 2051,
			"createDate": 1334600188,
			"position": {
				"x": 16,
				"y": 24
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe50e97": {
			"id": "1_BuildingNature_2049_4f8c61fe50aa4",
			"type": 2049,
			"createDate": 1334600188,
			"position": {
				"x": 16,
				"y": 17
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe516b0": {
			"id": "1_BuildingNature_2049_4f8c61fe51270",
			"type": 2049,
			"createDate": 1334600188,
			"position": {
				"x": 16,
				"y": 36
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe51df0": {
			"id": "1_BuildingNature_2049_4f8c61fe51a37",
			"type": 2049,
			"createDate": 1334600188,
			"position": {
				"x": 16,
				"y": 38
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe52661": {
			"id": "1_BuildingNature_2045_4f8c61fe521d7",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 17,
				"y": 16
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe52e1c": {
			"id": "1_BuildingNature_2053_4f8c61fe529d4",
			"type": 2053,
			"createDate": 1334600188,
			"position": {
				"x": 17,
				"y": 12
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe5355f": {
			"id": "1_BuildingNature_2047_4f8c61fe53180",
			"type": 2047,
			"createDate": 1334600188,
			"position": {
				"x": 17,
				"y": 21
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe53d9f": {
			"id": "1_BuildingNature_2047_4f8c61fe539dd",
			"type": 2047,
			"createDate": 1334600188,
			"position": {
				"x": 17,
				"y": 31
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe5457f": {
			"id": "1_BuildingNature_2054_4f8c61fe54167",
			"type": 2054,
			"createDate": 1334600188,
			"position": {
				"x": 18,
				"y": 10
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe54cda": {
			"id": "1_BuildingNature_2051_4f8c61fe5493a",
			"type": 2051,
			"createDate": 1334600188,
			"position": {
				"x": 18,
				"y": 3
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe5549f": {
			"id": "1_BuildingNature_2044_4f8c61fe550b6",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 18,
				"y": 12
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe55c6f": {
			"id": "1_BuildingProduction_2003_4f8c61fe55889",
			"type": 2003,
			"createDate": 1334600188,
			"position": {
				"x": 21,
				"y": 38
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe564ef": {
			"id": "1_BuildingNature_2054_4f8c61fe5608d",
			"type": 2054,
			"createDate": 1334600188,
			"position": {
				"x": 18,
				"y": 30
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe5742e": {
			"id": "1_BuildingNature_2051_4f8c61fe57085",
			"type": 2051,
			"createDate": 1334600188,
			"position": {
				"x": 19,
				"y": 1
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe583a4": {
			"id": "1_BuildingNature_2051_4f8c61fe57f98",
			"type": 2051,
			"createDate": 1334600188,
			"position": {
				"x": 19,
				"y": 20
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe58b53": {
			"id": "1_BuildingNature_2053_4f8c61fe587c9",
			"type": 2053,
			"createDate": 1334600188,
			"position": {
				"x": 26,
				"y": 32
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe5939c": {
			"id": "1_BuildingNature_2053_4f8c61fe58fd6",
			"type": 2053,
			"createDate": 1334600188,
			"position": {
				"x": 19,
				"y": 17
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe59b98": {
			"id": "1_BuildingNature_2044_4f8c61fe597c2",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 19,
				"y": 12
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe5a2be": {
			"id": "1_BuildingNature_2044_4f8c61fe59ef7",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 20,
				"y": 7
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe5aaf7": {
			"id": "1_BuildingNature_2044_4f8c61fe5a6a6",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 20,
				"y": 9
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe5b30c": {
			"id": "1_BuildingNature_2050_4f8c61fe5ae9a",
			"type": 2050,
			"createDate": 1334600188,
			"position": {
				"x": 20,
				"y": 28
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe5ba5c": {
			"id": "1_BuildingNature_2049_4f8c61fe5b6fb",
			"type": 2049,
			"createDate": 1334600188,
			"position": {
				"x": 20,
				"y": 22
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe5c2aa": {
			"id": "1_BuildingNature_2054_4f8c61fe5be4f",
			"type": 2054,
			"createDate": 1334600188,
			"position": {
				"x": 31,
				"y": 35
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe5ca75": {
			"id": "1_BuildingNature_2050_4f8c61fe5c680",
			"type": 2050,
			"createDate": 1334600188,
			"position": {
				"x": 21,
				"y": 0
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe5d25e": {
			"id": "1_BuildingNature_2045_4f8c61fe5ce6c",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 21,
				"y": 13
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe5d994": {
			"id": "1_BuildingProduction_2001_4f8c61fe5d5a9",
			"type": 2001,
			"createDate": 1334600188,
			"position": {
				"x": 17,
				"y": 38
			},
			"isUsed": true,
			"step": 0,
			"childId": "1_ItemResource_7007_4f8e76943ddb3",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe5e133": {
			"id": "1_BuildingNature_2044_4f8c61fe5dd62",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 21,
				"y": 14
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe5e9cb": {
			"id": "1_BuildingNature_2049_4f8c61fe5e54a",
			"type": 2049,
			"createDate": 1334600188,
			"position": {
				"x": 22,
				"y": 9
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe5f0dc": {
			"id": "1_BuildingNature_2044_4f8c61fe5ecff",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 22,
				"y": 20
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe600f2": {
			"id": "1_BuildingNature_2051_4f8c61fe5fd3c",
			"type": 2051,
			"createDate": 1334600188,
			"position": {
				"x": 22,
				"y": 13
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe60851": {
			"id": "1_BuildingNature_2045_4f8c61fe604ad",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 22,
				"y": 15
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe610ce": {
			"id": "1_BuildingNature_2044_4f8c61fe60cf3",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 23,
				"y": 20
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe617ef": {
			"id": "1_BuildingNature_2045_4f8c61fe61408",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 23,
				"y": 18
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe62073": {
			"id": "1_BuildingNature_2056_4f8c61fe61bd5",
			"type": 2056,
			"createDate": 1334600188,
			"position": {
				"x": 23,
				"y": 19
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe62790": {
			"id": "1_BuildingNature_2051_4f8c61fe623dd",
			"type": 2051,
			"createDate": 1334600188,
			"position": {
				"x": 24,
				"y": 0
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe62f5f": {
			"id": "1_BuildingNature_2044_4f8c61fe62b78",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 24,
				"y": 18
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe63787": {
			"id": "1_BuildingNature_2044_4f8c61fe63346",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 24,
				"y": 19
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe63eff": {
			"id": "1_BuildingNature_2054_4f8c61fe63b3f",
			"type": 2054,
			"createDate": 1334600188,
			"position": {
				"x": 27,
				"y": 39
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe6478d": {
			"id": "1_BuildingNature_2050_4f8c61fe642e8",
			"type": 2050,
			"createDate": 1334600188,
			"position": {
				"x": 24,
				"y": 23
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe656a5": {
			"id": "1_BuildingNature_2045_4f8c61fe6533d",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 24,
				"y": 15
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe66611": {
			"id": "1_BuildingNature_2050_4f8c61fe662bc",
			"type": 2050,
			"createDate": 1334600188,
			"position": {
				"x": 25,
				"y": 0
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe66e14": {
			"id": "1_BuildingNature_2044_4f8c61fe669f5",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 25,
				"y": 20
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe675af": {
			"id": "1_BuildingNature_2044_4f8c61fe671e9",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 25,
				"y": 21
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe67d85": {
			"id": "1_BuildingNature_2056_4f8c61fe67994",
			"type": 2056,
			"createDate": 1334600188,
			"position": {
				"x": 25,
				"y": 32
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe685ce": {
			"id": "1_BuildingNature_2051_4f8c61fe68167",
			"type": 2051,
			"createDate": 1334600188,
			"position": {
				"x": 29,
				"y": 36
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe68da5": {
			"id": "1_BuildingNature_2054_4f8c61fe689b4",
			"type": 2054,
			"createDate": 1334600188,
			"position": {
				"x": 25,
				"y": 11
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe69564": {
			"id": "1_BuildingNature_2056_4f8c61fe69151",
			"type": 2056,
			"createDate": 1334600188,
			"position": {
				"x": 25,
				"y": 29
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe69d00": {
			"id": "1_BuildingDecor_2036_4f8c61fe69953",
			"type": 2036,
			"createDate": 1334600188,
			"position": {
				"x": 25,
				"y": 30
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe6a4f3": {
			"id": "1_BuildingNature_2045_4f8c61fe6a0cb",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 25,
				"y": 15
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe6ac5d": {
			"id": "1_BuildingNature_2054_4f8c61fe6a89f",
			"type": 2054,
			"createDate": 1334600188,
			"position": {
				"x": 26,
				"y": 6
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe6bcd0": {
			"id": "1_BuildingNature_2045_4f8c61fe6b8ae",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 26,
				"y": 15
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe6c47c": {
			"id": "1_BuildingNature_2056_4f8c61fe6c063",
			"type": 2056,
			"createDate": 1334600188,
			"position": {
				"x": 27,
				"y": 32
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe6d423": {
			"id": "1_BuildingNature_2050_4f8c61fe6d042",
			"type": 2050,
			"createDate": 1334600188,
			"position": {
				"x": 27,
				"y": 14
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe6e42c": {
			"id": "1_BuildingNature_2053_4f8c61fe6df97",
			"type": 2053,
			"createDate": 1334600188,
			"position": {
				"x": 27,
				"y": 10
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe6eb80": {
			"id": "1_BuildingNature_2049_4f8c61fe6e6fa",
			"type": 2049,
			"createDate": 1334600188,
			"position": {
				"x": 27,
				"y": 11
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe6f2d5": {
			"id": "1_BuildingNature_2056_4f8c61fe6ef23",
			"type": 2056,
			"createDate": 1334600188,
			"position": {
				"x": 27,
				"y": 29
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe6fb1e": {
			"id": "1_BuildingDecor_2023_4f8c61fe6f693",
			"type": 2023,
			"createDate": 1334600188,
			"position": {
				"x": 27,
				"y": 30
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe702d8": {
			"id": "1_BuildingNature_2053_4f8c61fe6fed8",
			"type": 2053,
			"createDate": 1334600188,
			"position": {
				"x": 24,
				"y": 31
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe70a26": {
			"id": "1_BuildingNature_2045_4f8c61fe706c0",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 28,
				"y": 8
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe71256": {
			"id": "1_BuildingProduction_2001_4f8c61fe70e6e",
			"type": 2001,
			"createDate": 1334600188,
			"position": {
				"x": 28,
				"y": 0
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe71a2f": {
			"id": "1_BuildingNature_2053_4f8c61fe715d8",
			"type": 2053,
			"createDate": 1334600188,
			"position": {
				"x": 24,
				"y": 30
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe72219": {
			"id": "1_BuildingDecor_2023_4f8c61fe71e37",
			"type": 2023,
			"createDate": 1334600188,
			"position": {
				"x": 28,
				"y": 30
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe72a17": {
			"id": "1_BuildingNature_2045_4f8c61fe725de",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 28,
				"y": 23
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe738fb": {
			"id": "1_BuildingNature_2053_4f8c61fe7351c",
			"type": 2053,
			"createDate": 1334600188,
			"position": {
				"x": 24,
				"y": 32
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe7417f": {
			"id": "1_BuildingNature_2051_4f8c61fe73d85",
			"type": 2051,
			"createDate": 1334600188,
			"position": {
				"x": 29,
				"y": 5
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe7489f": {
			"id": "1_BuildingDecor_2023_4f8c61fe74530",
			"type": 2023,
			"createDate": 1334600188,
			"position": {
				"x": 29,
				"y": 30
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe750f9": {
			"id": "1_BuildingNature_2044_4f8c61fe74c88",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 29,
				"y": 23
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe767dd": {
			"id": "1_BuildingNature_2053_4f8c61fe7641f",
			"type": 2053,
			"createDate": 1334600188,
			"position": {
				"x": 30,
				"y": 3
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe76fb0": {
			"id": "1_BuildingNature_2049_4f8c61fe76bc5",
			"type": 2049,
			"createDate": 1334600188,
			"position": {
				"x": 30,
				"y": 10
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe77809": {
			"id": "1_BuildingDecor_2074_4f8c61fe77427",
			"type": 2074,
			"createDate": 1334600188,
			"position": {
				"x": 30,
				"y": 20
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe77fdb": {
			"id": "1_BuildingDecor_2023_4f8c61fe77c09",
			"type": 2023,
			"createDate": 1334600188,
			"position": {
				"x": 30,
				"y": 23
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe78724": {
			"id": "1_BuildingDecor_2023_4f8c61fe783dd",
			"type": 2023,
			"createDate": 1334600188,
			"position": {
				"x": 30,
				"y": 24
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe78f9f": {
			"id": "1_BuildingDecor_2023_4f8c61fe78b61",
			"type": 2023,
			"createDate": 1334600188,
			"position": {
				"x": 30,
				"y": 25
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe79735": {
			"id": "1_BuildingDecor_2023_4f8c61fe7936e",
			"type": 2023,
			"createDate": 1334600188,
			"position": {
				"x": 30,
				"y": 26
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe79eb5": {
			"id": "1_BuildingDecor_2023_4f8c61fe79b04",
			"type": 2023,
			"createDate": 1334600188,
			"position": {
				"x": 30,
				"y": 27
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe7a65d": {
			"id": "1_BuildingDecor_2023_4f8c61fe7a275",
			"type": 2023,
			"createDate": 1334600188,
			"position": {
				"x": 30,
				"y": 28
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe7ae31": {
			"id": "1_BuildingDecor_2023_4f8c61fe7aa46",
			"type": 2023,
			"createDate": 1334600188,
			"position": {
				"x": 30,
				"y": 29
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe7b64f": {
			"id": "1_BuildingDecor_2023_4f8c61fe7b2ad",
			"type": 2023,
			"createDate": 1334600188,
			"position": {
				"x": 30,
				"y": 30
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe7bdd6": {
			"id": "1_BuildingDecor_2022_4f8c61fe7ba81",
			"type": 2022,
			"createDate": 1334600188,
			"position": {
				"x": 29,
				"y": 38
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe7cdf2": {
			"id": "1_BuildingNature_2044_4f8c61fe7c9e1",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 31,
				"y": 8
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe7d5f8": {
			"id": "1_BuildingNature_2045_4f8c61fe7d1be",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 27,
				"y": 36
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe7dd68": {
			"id": "1_BuildingNature_2045_4f8c61fe7d9ad",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 28,
				"y": 36
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe7e4e5": {
			"id": "1_BuildingNature_2045_4f8c61fe7e0f4",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 27,
				"y": 38
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe7ed38": {
			"id": "1_BuildingNature_2045_4f8c61fe7e97a",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 27,
				"y": 37
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe7f4a8": {
			"id": "1_BuildingDecor_2023_4f8c61fe7f0db",
			"type": 2023,
			"createDate": 1334600188,
			"position": {
				"x": 31,
				"y": 30
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe7fcc5": {
			"id": "1_BuildingHouse_2004_4f8c61fe7f910",
			"type": 2004,
			"createDate": 1334600188,
			"position": {
				"x": 32,
				"y": 37
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 1334743929,
			"slots": []
		},
		"buildingCollection_4f8c61fe80425": {
			"id": "1_BuildingNature_2048_4f8c61fe800c1",
			"type": 2048,
			"createDate": 1334600188,
			"position": {
				"x": 31,
				"y": 39
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe80c18": {
			"id": "1_BuildingNature_2047_4f8c61fe808ed",
			"type": 2047,
			"createDate": 1334600188,
			"position": {
				"x": 31,
				"y": 25
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe813ff": {
			"id": "1_BuildingNature_2047_4f8c61fe80fd8",
			"type": 2047,
			"createDate": 1334600188,
			"position": {
				"x": 31,
				"y": 24
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe81c22": {
			"id": "1_BuildingDecor_2023_4f8c61fe817a7",
			"type": 2023,
			"createDate": 1334600188,
			"position": {
				"x": 32,
				"y": 32
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe823b6": {
			"id": "1_BuildingDecor_2023_4f8c61fe81f9b",
			"type": 2023,
			"createDate": 1334600188,
			"position": {
				"x": 32,
				"y": 31
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe82b2e": {
			"id": "1_BuildingNature_2050_4f8c61fe82770",
			"type": 2050,
			"createDate": 1334600188,
			"position": {
				"x": 32,
				"y": 0
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe83301": {
			"id": "1_BuildingNature_2047_4f8c61fe82f15",
			"type": 2047,
			"createDate": 1334600188,
			"position": {
				"x": 32,
				"y": 5
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe83ad0": {
			"id": "1_BuildingNature_2048_4f8c61fe836e8",
			"type": 2048,
			"createDate": 1334600188,
			"position": {
				"x": 31,
				"y": 38
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe842bc": {
			"id": "1_BuildingNature_2044_4f8c61fe83f30",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 32,
				"y": 12
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe84aeb": {
			"id": "1_BuildingNature_2046_4f8c61fe84725",
			"type": 2046,
			"createDate": 1334600188,
			"position": {
				"x": 32,
				"y": 15
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe852ec": {
			"id": "1_BuildingNature_2047_4f8c61fe84f0e",
			"type": 2047,
			"createDate": 1334600188,
			"position": {
				"x": 32,
				"y": 8
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe85a8f": {
			"id": "1_BuildingNature_2045_4f8c61fe85654",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 32,
				"y": 23
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe8625c": {
			"id": "1_BuildingDecor_2023_4f8c61fe85eb6",
			"type": 2023,
			"createDate": 1334600188,
			"position": {
				"x": 32,
				"y": 30
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe879f8": {
			"id": "1_BuildingNature_2051_4f8c61fe875eb",
			"type": 2051,
			"createDate": 1334600188,
			"position": {
				"x": 33,
				"y": 6
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe8811b": {
			"id": "1_BuildingNature_2053_4f8c61fe87dab",
			"type": 2053,
			"createDate": 1334600188,
			"position": {
				"x": 33,
				"y": 8
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe88993": {
			"id": "1_BuildingNature_2045_4f8c61fe88565",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 33,
				"y": 21
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe890ec": {
			"id": "1_BuildingNature_2044_4f8c61fe88d4d",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 33,
				"y": 15
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe89921": {
			"id": "1_BuildingHouse_2004_4f8c61fe8950c",
			"type": 2004,
			"createDate": 1334600188,
			"position": {
				"x": 34,
				"y": 35
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 1334743914,
			"slots": []
		},
		"buildingCollection_4f8c61fe8a050": {
			"id": "1_BuildingNature_2048_4f8c61fe89cba",
			"type": 2048,
			"createDate": 1334600188,
			"position": {
				"x": 31,
				"y": 37
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe8b029": {
			"id": "1_BuildingNature_2044_4f8c61fe8ac18",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 34,
				"y": 14
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe8b7ce": {
			"id": "1_BuildingNature_2045_4f8c61fe8b3e5",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 34,
				"y": 19
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe8c76c": {
			"id": "1_BuildingNature_2048_4f8c61fe8c384",
			"type": 2048,
			"createDate": 1334600188,
			"position": {
				"x": 31,
				"y": 36
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe8cf5c": {
			"id": "1_BuildingNature_2049_4f8c61fe8cbdf",
			"type": 2049,
			"createDate": 1334600188,
			"position": {
				"x": 35,
				"y": 2
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe8d73e": {
			"id": "1_BuildingNature_2053_4f8c61fe8d3d1",
			"type": 2053,
			"createDate": 1334600188,
			"position": {
				"x": 35,
				"y": 21
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe8dedf": {
			"id": "1_BuildingDecor_2033_4f8c61fe8daf6",
			"type": 2033,
			"createDate": 1334600188,
			"position": {
				"x": 35,
				"y": 11
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe8e6b1": {
			"id": "1_BuildingHouse_2004_4f8c61fe8e2c4",
			"type": 2004,
			"createDate": 1334600188,
			"position": {
				"x": 36,
				"y": 37
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 1334743926,
			"slots": []
		},
		"buildingCollection_4f8c61fe8ee7c": {
			"id": "1_BuildingNature_2044_4f8c61fe8ea93",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 35,
				"y": 15
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe8f64e": {
			"id": "1_BuildingDecor_2072_4f8c61fe8f266",
			"type": 2072,
			"createDate": 1334600188,
			"position": {
				"x": 38,
				"y": 27
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe8fe20": {
			"id": "1_BuildingProduction_2003_4f8c61fe8fad5",
			"type": 2003,
			"createDate": 1334600188,
			"position": {
				"x": 36,
				"y": 4
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe9068a": {
			"id": "1_BuildingNature_2049_4f8c61fe90203",
			"type": 2049,
			"createDate": 1334600188,
			"position": {
				"x": 36,
				"y": 8
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe90e85": {
			"id": "1_BuildingNature_2044_4f8c61fe90a67",
			"type": 2044,
			"createDate": 1334600188,
			"position": {
				"x": 36,
				"y": 15
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe915b9": {
			"id": "1_BuildingNature_2053_4f8c61fe91273",
			"type": 2053,
			"createDate": 1334600188,
			"position": {
				"x": 24,
				"y": 29
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe91e0c": {
			"id": "1_BuildingHouse_2004_4f8c61fe919ec",
			"type": 2004,
			"createDate": 1334600188,
			"position": {
				"x": 38,
				"y": 35
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 1334743920,
			"slots": []
		},
		"buildingCollection_4f8c61fe9252c": {
			"id": "1_BuildingHouse_2004_4f8c61fe9218d",
			"type": 2004,
			"createDate": 1334600188,
			"position": {
				"x": 38,
				"y": 37
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 1334743923,
			"slots": []
		},
		"buildingCollection_4f8c61fe92d7b": {
			"id": "1_BuildingProduction_2077_4f8c61fe92913",
			"type": 2077,
			"createDate": 1334600188,
			"position": {
				"x": 38,
				"y": 22
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe93d3f": {
			"id": "1_BuildingDecor_2072_4f8c61fe93806",
			"type": 2072,
			"createDate": 1334600188,
			"position": {
				"x": 38,
				"y": 26
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe944fb": {
			"id": "1_BuildingProduction_2002_4f8c61fe94158",
			"type": 2002,
			"createDate": 1334600188,
			"position": {
				"x": 38,
				"y": 28
			},
			"isUsed": true,
			"step": 0,
			"childId": "1_ItemResource_5005_4f8e86fef2142",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe957f3": {
			"id": "1_BuildingNature_2045_4f8c61fe9540d",
			"type": 2045,
			"createDate": 1334600188,
			"position": {
				"x": 38,
				"y": 21
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe9600e": {
			"id": "1_BuildingNature_2046_4f8c61fe95c11",
			"type": 2046,
			"createDate": 1334600188,
			"position": {
				"x": 38,
				"y": 25
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe96813": {
			"id": "1_BuildingNature_2050_4f8c61fe9645d",
			"type": 2050,
			"createDate": 1334600188,
			"position": {
				"x": 39,
				"y": 9
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe96f65": {
			"id": "1_BuildingNature_2054_4f8c61fe96c47",
			"type": 2054,
			"createDate": 1334600188,
			"position": {
				"x": 39,
				"y": 34
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe97734": {
			"id": "1_BuildingNature_2050_4f8c61fe9734c",
			"type": 2050,
			"createDate": 1334600188,
			"position": {
				"x": 39,
				"y": 6
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe986d2": {
			"id": "1_BuildingNature_2050_4f8c61fe982f0",
			"type": 2050,
			"createDate": 1334600188,
			"position": {
				"x": 39,
				"y": 13
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe99673": {
			"id": "1_BuildingNature_2046_4f8c61fe99339",
			"type": 2046,
			"createDate": 1334600188,
			"position": {
				"x": 39,
				"y": 33
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c61fe9a65d": {
			"id": "1_BuildingNature_2046_4f8c61fe9a2f0",
			"type": 2046,
			"createDate": 1334600188,
			"position": {
				"x": 39,
				"y": 25
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c6232efb69": {
			"id": "1_BuildingProduction_2002_4f8c6232ef324",
			"type": 2002,
			"createDate": 1334600242,
			"position": {
				"x": 36,
				"y": 28
			},
			"isUsed": true,
			"step": 0,
			"childId": "1_ItemResource_5005_4f8e86ffb7ba6",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c624c76024": {
			"id": "1_BuildingProduction_2002_4f8c624c758f4",
			"type": 2002,
			"createDate": 1334600268,
			"position": {
				"x": 36,
				"y": 26
			},
			"isUsed": true,
			"step": 0,
			"childId": "1_ItemResource_5005_4f8e8702a6ab2",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c62b21aa7f": {
			"id": "1_BuildingProduction_2002_4f8c62b21a2a9",
			"type": 2002,
			"createDate": 1334600370,
			"position": {
				"x": 36,
				"y": 24
			},
			"isUsed": true,
			"step": 0,
			"childId": "1_ItemResource_5005_4f8e87018c02d",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c62b8ba100": {
			"id": "1_BuildingProduction_2002_4f8c62b8b9991",
			"type": 2002,
			"createDate": 1334600376,
			"position": {
				"x": 34,
				"y": 24
			},
			"isUsed": true,
			"step": 0,
			"childId": "1_ItemResource_5005_4f8e870921580",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c64656d866": {
			"id": "1_BuildingHouse_2004_4f8c64656d13d",
			"type": 2004,
			"createDate": 1334600807,
			"position": {
				"x": 34,
				"y": 37
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 1334743932,
			"slots": []
		},
		"buildingCollection_4f8c64cc888d3": {
			"id": "1_BuildingProduction_2019_4f8c64cc884ee",
			"type": 2019,
			"createDate": 1334600910,
			"position": {
				"x": 28,
				"y": 28
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c64dea9fc7": {
			"id": "1_BuildingProduction_2081_4f8c64dea9b56",
			"type": 2081,
			"createDate": 1334600928,
			"position": {
				"x": 28,
				"y": 26
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8c6516ed744": {
			"id": "1_BuildingHouse_2004_4f8c6516ed2c0",
			"type": 2004,
			"createDate": 1334600984,
			"position": {
				"x": 36,
				"y": 35
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 1334743917,
			"slots": []
		},
		"buildingCollection_4f8c6590293f1": {
			"id": "1_BuildingProduction_2082_4f8c659028bcb",
			"type": 2082,
			"createDate": 1334601106,
			"position": {
				"x": 24,
				"y": 27
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8ceecad76b8": {
			"id": "1_BuildingProduction_2002_4f8ceecad6ec1",
			"type": 2002,
			"createDate": 1334636234,
			"position": {
				"x": 32,
				"y": 24
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8cef0e14a1c": {
			"id": "1_BuildingHouse_2004_4f8cef0e1462e",
			"type": 2004,
			"createDate": 1334636304,
			"position": {
				"x": 19,
				"y": 38
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 1334740613,
			"slots": []
		},
		"buildingCollection_4f8cef71ea319": {
			"id": "1_BuildingHouse_2004_4f8cef71e9f2c",
			"type": 2004,
			"createDate": 1334636404,
			"position": {
				"x": 32,
				"y": 35
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 1334743911,
			"slots": []
		},
		"buildingCollection_4f8db65c278cf": {
			"id": "1_BuildingHouse_2020_4f8db65c27171",
			"type": 2020,
			"createDate": 1334687327,
			"position": {
				"x": 37,
				"y": 31
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 1334743907,
			"slots": []
		},
		"buildingCollection_4f8db743c29c1": {
			"id": "1_BuildingProduction_2002_4f8db743c1e6f",
			"type": 2002,
			"createDate": 1334687555,
			"position": {
				"x": 34,
				"y": 26
			},
			"isUsed": true,
			"step": 0,
			"childId": "1_ItemResource_5005_4f8e8707d312a",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8db749791a2": {
			"id": "1_BuildingHouse_2020_4f8db74978a5a",
			"type": 2020,
			"createDate": 1334687563,
			"position": {
				"x": 35,
				"y": 31
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 1334743904,
			"slots": []
		},
		"buildingCollection_4f8dc744b19fb": {
			"id": "1_BuildingCiv_2076_4f8dc744b1610",
			"type": 2076,
			"createDate": 1334691656,
			"position": {
				"x": 19,
				"y": 32
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 1334740610,
			"slots": [{
				"friendId": -1,
				"fullname": "",
				"avatar": ""
			},
			{
				"friendId": -1,
				"fullname": "",
				"avatar": ""
			}]
		},
		"buildingCollection_4f8dc7d5e7247": {
			"id": "1_BuildingCiv_2076_4f8dc7d5e6a4f",
			"type": 2076,
			"createDate": 1334691800,
			"position": {
				"x": 33,
				"y": 28
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 1334740716,
			"slots": [{
				"friendId": -1,
				"fullname": "",
				"avatar": ""
			},
			{
				"friendId": -1,
				"fullname": "",
				"avatar": ""
			}]
		},
		"buildingCollection_4f8dc84b76391": {
			"id": "1_BuildingCiv_2076_4f8dc84b75fb1",
			"type": 2076,
			"createDate": 1334691919,
			"position": {
				"x": 16,
				"y": 32
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 1334740607,
			"slots": [{
				"friendId": -1,
				"fullname": "",
				"avatar": ""
			},
			{
				"friendId": -1,
				"fullname": "",
				"avatar": ""
			}]
		},
		"buildingCollection_4f8dc8ed13d3a": {
			"id": "1_BuildingHouse_2020_4f8dc8ed1395e",
			"type": 2020,
			"createDate": 1334692081,
			"position": {
				"x": 25,
				"y": 38
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 1334740616,
			"slots": []
		},
		"buildingCollection_4f8e2b30655c9": {
			"id": "1_BuildingDecor_2023_4f8e2b3064d8a",
			"type": 2023,
			"createDate": 1334717232,
			"position": {
				"x": 32,
				"y": 33
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8e2b316b752": {
			"id": "1_BuildingDecor_2023_4f8e2b316ab68",
			"type": 2023,
			"createDate": 1334717233,
			"position": {
				"x": 32,
				"y": 34
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8e2b3246d9d": {
			"id": "1_BuildingDecor_2023_4f8e2b3246580",
			"type": 2023,
			"createDate": 1334717234,
			"position": {
				"x": 31,
				"y": 34
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8e2b33079a4": {
			"id": "1_BuildingDecor_2023_4f8e2b33071dd",
			"type": 2023,
			"createDate": 1334717235,
			"position": {
				"x": 30,
				"y": 34
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8e2b33a2d70": {
			"id": "1_BuildingDecor_2023_4f8e2b33a25a9",
			"type": 2023,
			"createDate": 1334717235,
			"position": {
				"x": 30,
				"y": 35
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8e2b356ca96": {
			"id": "1_BuildingDecor_2023_4f8e2b356be9a",
			"type": 2023,
			"createDate": 1334717237,
			"position": {
				"x": 29,
				"y": 35
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8e2b368c1ce": {
			"id": "1_BuildingDecor_2023_4f8e2b368ba0d",
			"type": 2023,
			"createDate": 1334717238,
			"position": {
				"x": 28,
				"y": 35
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"buildingCollection_4f8e2b379a127": {
			"id": "1_BuildingDecor_2023_4f8e2b37994ac",
			"type": 2023,
			"createDate": 1334717239,
			"position": {
				"x": 27,
				"y": 35
			},
			"isUsed": true,
			"step": 0,
			"childId": "",
			"skipHarvestTime": 0,
			"lastHarvest": 0,
			"slots": []
		},
		"itemCollection_4f8e76943e18c": {
			"id": "1_ItemResource_7007_4f8e76943ddb3",
			"type": 7007,
			"quantity": 1,
			"createDate": 1334736532,
			"parentId": "1_BuildingProduction_2001_4f8c61fe5d5a9",
			"skipHarvestTime": 0
		},
		"itemCollection_4f8e86fef2503": {
			"id": "1_ItemResource_5005_4f8e86fef2142",
			"type": 5005,
			"quantity": 1,
			"createDate": 1334740734,
			"parentId": "1_BuildingProduction_2002_4f8c61fe94158",
			"skipHarvestTime": 0
		},
		"itemCollection_4f8e86ffb7f66": {
			"id": "1_ItemResource_5005_4f8e86ffb7ba6",
			"type": 5005,
			"quantity": 1,
			"createDate": 1334740735,
			"parentId": "1_BuildingProduction_2002_4f8c6232ef324",
			"skipHarvestTime": 0
		},
		"itemCollection_4f8e87018c4f0": {
			"id": "1_ItemResource_5005_4f8e87018c02d",
			"type": 5005,
			"quantity": 1,
			"createDate": 1334740737,
			"parentId": "1_BuildingProduction_2002_4f8c62b21a2a9",
			"skipHarvestTime": 0
		},
		"itemCollection_4f8e8702a6e46": {
			"id": "1_ItemResource_5005_4f8e8702a6ab2",
			"type": 5005,
			"quantity": 1,
			"createDate": 1334740738,
			"parentId": "1_BuildingProduction_2002_4f8c624c758f4",
			"skipHarvestTime": 0
		},
		"itemCollection_4f8e8707d3539": {
			"id": "1_ItemResource_5005_4f8e8707d312a",
			"type": 5005,
			"quantity": 1,
			"createDate": 1334740743,
			"parentId": "1_BuildingProduction_2002_4f8db743c1e6f",
			"skipHarvestTime": 0
		},
		"itemCollection_4f8e8709218d9": {
			"id": "1_ItemResource_5005_4f8e870921580",
			"type": 5005,
			"quantity": 1,
			"createDate": 1334740745,
			"parentId": "1_BuildingProduction_2002_4f8c62b8b9991",
			"skipHarvestTime": 0
		},
		"soldierCollection_4f8d10010c0ca": {
			"id": "1_SoldierCol_9022_1_4f8d10010b94c",
			"type": 9022,
			"createDate": 1334644737,
			"position": {
				"x": 28,
				"y": 24
			},
			"parentId": "",
			"maxHP": 28,
			"curHP": 28,
			"damage": 18,
			"arm": 1,
			"defence": 10,
			"level": 1,
			"critical": 5,
			"avoidance": 5
		},
		"soldierCollection_4f8d10031a32e": {
			"id": "1_SoldierNormal_9001_1_4f8d100319c1d",
			"type": 9001,
			"createDate": 1334644739,
			"position": {
				"x": 29,
				"y": 24
			},
			"parentId": "",
			"maxHP": 16,
			"curHP": 16,
			"damage": 26,
			"arm": 0,
			"defence": 10,
			"level": 1,
			"critical": 5,
			"avoidance": 5
		},
		"soldierCollection_4f8d1006cafa1": {
			"id": "1_SoldierNormal_9043_1_4f8d1006ca802",
			"type": 9043,
			"createDate": 1334644742,
			"position": {
				"x": 28,
				"y": 25
			},
			"parentId": "",
			"maxHP": 52,
			"curHP": 52,
			"damage": 23,
			"arm": 2,
			"defence": 4,
			"level": 1,
			"critical": 5,
			"avoidance": 5
		}
	}
}';
			$arr =  json_decode($json);
			echo $json;
		}catch(Exception $ex){
			$this->view->form = $form->obj;
			$this->view->errMsg = $ex->getMessage();
			echo $this->view->errMsg;
			Utility::log($ex->getMessage(), $ex->getFile(), $ex->getLine());
		}
	}	
}
