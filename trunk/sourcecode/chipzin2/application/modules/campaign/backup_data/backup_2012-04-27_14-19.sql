DELETE FROM `c_award` WHERE 1;
 ALTER TABLE c_award AUTO_INCREMENT=1; 
DELETE FROM `c_award_type` WHERE 1;
 ALTER TABLE c_award_type AUTO_INCREMENT=1; 
DELETE FROM `c_battle_soldier` WHERE 1;
 ALTER TABLE c_battle_soldier AUTO_INCREMENT=1; 
DELETE FROM `c_battle` WHERE 1;
 ALTER TABLE c_battle AUTO_INCREMENT=1;
 DELETE FROM `c_layout` WHERE 1;
 ALTER TABLE c_layout AUTO_INCREMENT=1; 
DELETE FROM `c_soldier` WHERE 1;
 ALTER TABLE c_soldier AUTO_INCREMENT=1; 
DELETE FROM `c_nextcamp` WHERE 1;
 ALTER TABLE c_nextcamp AUTO_INCREMENT=1; 
DELETE FROM `c_campaign` WHERE 1;
 ALTER TABLE c_campaign AUTO_INCREMENT=1; 
DELETE FROM `c_typemap` WHERE 1;
 ALTER TABLE c_typemap AUTO_INCREMENT=1; 
DELETE FROM `c_worldmap` WHERE 1;
 ALTER TABLE c_worldmap AUTO_INCREMENT=1;
 INSERT INTO `c_soldier` VALUES('15002', 'Thi?t b?', '', 'SOLDIER_ENEMY_NORMAL_2'); 
INSERT INTO `c_soldier` VALUES('15003', 'Th? b?', '', 'SOLDIER_ENEMY_NORMAL_3'); 
INSERT INTO `c_soldier` VALUES('15004', 'Ng?u b?', '', 'SOLDIER_ENEMY_NORMAL_4'); 
INSERT INTO `c_soldier` VALUES('15005', 'Th?ch b?', '', 'SOLDIER_ENEMY_NORMAL_5'); 
INSERT INTO `c_soldier` VALUES('15006', 'S�t b?', '', 'SOLDIER_ENEMY_NORMAL_6'); 
INSERT INTO `c_soldier` VALUES('15007', 'Di b?', '', 'SOLDIER_ENEMY_NORMAL_7'); 
INSERT INTO `c_soldier` VALUES('15008', 'T?n b?', '', 'SOLDIER_ENEMY_NORMAL_8'); 
INSERT INTO `c_soldier` VALUES('15009', 'Trung b?', '', 'SOLDIER_ENEMY_NORMAL_9'); 
INSERT INTO `c_soldier` VALUES('15010', 'Ho�nh b?', '', 'SOLDIER_ENEMY_ROW_1'); 
INSERT INTO `c_soldier` VALUES('15011', 'Tung b?', '', 'SOLDIER_ENEMY_COL_1'); 
INSERT INTO `c_soldier` VALUES('15012', 'To�n b?', '', 'SOLDIER_ENEMY_ALL_1'); 
INSERT INTO `c_soldier` VALUES('15013', 'C�ng k?', '', 'SOLDIER_ENEMY_NORMAL_10'); 
INSERT INTO `c_soldier` VALUES('15014', 'Thi?t k?', '', 'SOLDIER_ENEMY_NORMAL_11'); 
INSERT INTO `c_soldier` VALUES('15015', 'Th? k?', '', 'SOLDIER_ENEMY_NORMAL_12'); 
INSERT INTO `c_soldier` VALUES('15016', 'Ng?u k?', '', 'SOLDIER_ENEMY_NORMAL_13'); 
INSERT INTO `c_soldier` VALUES('15017', 'Th?ch k?', '', 'SOLDIER_ENEMY_NORMAL_14'); 
INSERT INTO `c_soldier` VALUES('15018', 'S�t k?', '', 'SOLDIER_ENEMY_NORMAL_15'); 
INSERT INTO `c_soldier` VALUES('15019', 'Di k?', '', 'SOLDIER_ENEMY_NORMAL_16'); 
INSERT INTO `c_soldier` VALUES('15020', 'T?n k?', '', 'SOLDIER_ENEMY_NORMAL_17'); 
INSERT INTO `c_soldier` VALUES('15021', 'Trung k?', '', 'SOLDIER_ENEMY_NORMAL_18'); 
INSERT INTO `c_soldier` VALUES('15022', 'Ho�nh k?', '', 'SOLDIER_ENEMY_ROW_2'); 
INSERT INTO `c_soldier` VALUES('15023', 'Tung k?', '', 'SOLDIER_ENEMY_COL_2'); 
INSERT INTO `c_soldier` VALUES('15024', 'To�n k?', '', 'SOLDIER_ENEMY_ALL_2'); 
INSERT INTO `c_soldier` VALUES('15025', 'C�ng ph�o', '', 'SOLDIER_ENEMY_NORMAL_19'); 
INSERT INTO `c_soldier` VALUES('15026', 'Thi?t ph�o', '', 'SOLDIER_ENEMY_NORMAL_20'); 
INSERT INTO `c_soldier` VALUES('15027', 'Th? ph�o', '', 'SOLDIER_ENEMY_NORMAL_21'); 
INSERT INTO `c_soldier` VALUES('15028', 'Ng?u ph�o', '', 'SOLDIER_ENEMY_NORMAL_22'); 
INSERT INTO `c_soldier` VALUES('15029', 'Th?ch ph�o', '', 'SOLDIER_ENEMY_NORMAL_23'); 
INSERT INTO `c_soldier` VALUES('15030', 'S�t ph�o', '', 'SOLDIER_ENEMY_NORMAL_24'); 
INSERT INTO `c_soldier` VALUES('15031', 'Di ph�o', '', 'SOLDIER_ENEMY_NORMAL_25'); 
INSERT INTO `c_soldier` VALUES('15032', 'T?n ph�o', '', 'SOLDIER_ENEMY_NORMAL_26'); 
INSERT INTO `c_soldier` VALUES('15033', 'Trung ph�o', '', 'SOLDIER_ENEMY_NORMAL_27'); 
INSERT INTO `c_soldier` VALUES('15034', 'Ho�nh ph�o', '', 'SOLDIER_ENEMY_ROW_3'); 
INSERT INTO `c_soldier` VALUES('15035', 'Tung ph�o', '', 'SOLDIER_ENEMY_COL_3'); 
INSERT INTO `c_soldier` VALUES('15036', 'To�n ph�o', '', 'SOLDIER_ENEMY_ALL_3'); 
INSERT INTO `c_layout` VALUES('1', 'T', '[1,1,1,0,1,0,0,1,0]', ''); 
INSERT INTO `c_layout` VALUES('2', '+', '[0,1,0,1,1,1,0,1,0]', ''); 
INSERT INTO `c_layout` VALUES('3', 'X', '[1,0,1,0,1,0,1,0,1]', ''); 
INSERT INTO `c_layout` VALUES('7', 'V', '[0,1,0,1,0,1,1,0,1]', ''); 
INSERT INTO `c_layout` VALUES('8', 'Z', '[0,0,1,1,1,1,1,0,0]', ''); 
INSERT INTO `c_award_type` VALUES('1', 'Gold'); 
INSERT INTO `c_award_type` VALUES('2', 'Exp'); 
INSERT INTO `c_award_type` VALUES('3', 'Item'); 
INSERT INTO `c_award_type` VALUES('4', 'Iron'); 
INSERT INTO `c_award_type` VALUES('5', 'Wood'); 
