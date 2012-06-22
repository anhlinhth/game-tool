<?php
define('DB_MB1', 'membase1');
define('DB_MC1', 'memcache1');
/*******************************/
define('DB_LOCK', DB_MC1);
define('DB_BACKUP', DB_MB1);
/*******************************/
define('RESET_HOUR', 12);
/*******************************/
define("BUILDING", 'Building');
define("ITEM", 'item');
define("SOLDIER", 'Soldier');
/*******************************/
define("HONOUR", 'Honour');
define("ENERGY", 'Energy');
/*******************************/
define("GOLD", 'Gold');
define("COIN", 'Coin');
define("WOOD", 'Wood');
define("IRON", 'Iron');
define("CIV", 'civ');
/*******************************/
define("NO_LIMIT", 99999999);
define("INVALID", null);
define("GLOBAL_USER_ID", -1);
/*******************************/
define("GLOBAL_USER_LIST_QUANTITY", 100);
/*******************************/
define("BUILDING_GROUP_RESOURCE", "BuildingResource");
define("BUILDING_GROUP_SOLIDER", "BuildingSolider");
define("BUILDING_GROUP_DECOR", "BuildingDecor");
/*******************************/
define("ITEM_GROUP_BUFF", "ItemBuff");
define("ITEM_GROUP_BATTLE", "ItemBattle");
define("ITEM_GROUP_DECOR", "ItemDecor");
define("ITEM_GROUP_RESOURCE", "ItemResource");
/*******************************/
define("SOLDIER_GROUP_NORMAL", "SoldierNormal");
define("SOLDIER_GROUP_ROW", "SoldierRow");
define("SOLDIER_GROUP_COL", "SoldierCol");
define("SOLDIER_GROUP_ALL", "SoldierAll");
/*******************************/
define("ENERGY_NORMAL", 1);
/*******************************/
define("MAP_MAP1_BLOCK_1", 0);
define("MAP_MAP1_BLOCK_2", 1);
/*******************************/
define('QUEST_GROUP_LINE_1', 1);
define('QUEST_GROUP_LINE_2', 2);
/*******************************/
define('QUEST_TASK_CONSTRUCT_BUILDING', 1);
define('QUEST_TASK_MOVE_BUILDING', 2);
define('QUEST_TASK_HARVEST_BUILDING', 3);
define('QUEST_TASK_HARVEST_BUILDING_FRIEND', 4);
define('QUEST_TASK_EXPLOIT', 5);
define('QUEST_TASK_STORE_BUILDING', 6);
define('QUEST_TASK_RESTORE_BUIDLING', 7);
define('QUEST_TASK_SELL_BUIDLING', 8);
define('QUEST_TASK_BOOST_BUIDLING', 9);
define('QUEST_TASK_BOOST_BUIDLING_FRIEND', 10);
define('QUEST_TASK_BUILDING_PRODUCE', 11);
define('QUEST_TASK_BRIDGE', 12);

define('QUEST_TASK_BUY_ITEM', 1001);
define('QUEST_TASK_HARVEST_ITEM', 1002);
define('QUEST_TASK_HARVEST_ITEM_FRIEND', 1003);
define('QUEST_TASK_BOOST_ITEM', 1004);
define('QUEST_TASK_BOOST_ITEM_FRIEND', 1005);

define('QUEST_TASK_UNLOCK_BLOCK', 2001);
define('QUEST_TASK_RENAME_VILLAGE', 2002);

define('QUEST_TASK_OPEN_SHOP', 3001);
define('QUEST_TASK_UNLOCK_ITEM_SHOP', 3002);

define('QUEST_TASK_VISIT_FRIEND', 4001);
define('QUEST_TASK_REFRESH_FRIEND_LIST', 4002);
define('QUEST_TASK_CREATE_SMURF', 4003);
define('QUEST_TASK_UP_LEVEL', 4004);
define('QUEST_TASK_FINISH_TUTORIAL', 4005);
define('QUEST_TASK_COL_GOLD', 4006);
define('QUEST_TASK_COL_WOOD', 4008);
define('QUEST_TASK_COL_IRON', 4009);
/*******************************/
define("BUILDING_STEP_BUY", 2);
define("BUILDING_STEP_CONSTRUCT", 1);
define("BUILDING_STEP_FINISH", 0);
/*******************************/
define("SOLDIER_CLASS_KEO", 'keo');
define("SOLDIER_CLASS_BUA", 'bua');
define("SOLDIER_CLASS_BAO", 'bao');
/*******************************/
define("SOLDIER_ARM_INFANTRY", 'bobinh');
define("SOLDIER_ARM_NAVY", 'thuybinh');
define("SOLDIER_ARM_AIR_FORCE", 'khongbinh');
/*******************************/
define("BATTLE_RESULT_LOSE", -1);
define("BATTLE_RESULT_DRAW", 0);
define("BATTLE_RESULT_WIN", 1);
?>
