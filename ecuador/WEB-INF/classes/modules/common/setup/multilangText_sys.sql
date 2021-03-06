DELETE FROM `multilang_text` WHERE `moduleName` = 'common' AND `languageCode` = 'sys';
DELETE FROM `multilang_text` WHERE `moduleName` = 'system' AND `languageCode` = 'sys';
OPTIMIZE TABLE `multilang_text`;
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('1', 'common', 'sys','Edit');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('2', 'common', 'sys','Delete');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('3', 'common', 'sys','Accept');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('4', 'common', 'sys','Search');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('5', 'common', 'sys','First');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('6', 'common', 'sys','Prev.');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('7', 'common', 'sys','Page');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('8', 'common', 'sys','of');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('9', 'common', 'sys','Next');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('10', 'common', 'sys','Last');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('11', 'common', 'sys','English');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('12', 'common', 'sys','Yes');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('13', 'common', 'sys','No');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('14', 'common', 'sys','Close');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('15', 'common', 'sys','action: edit');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('16', 'common', 'sys','action: create');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('17', 'common', 'sys','action: delete');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('18', 'common', 'sys','module');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('19', 'common', 'sys','users');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('20', 'common', 'sys','common');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('21', 'common', 'sys','system');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('22', 'common', 'sys','email');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('23', 'common', 'sys','import');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('24', 'common', 'sys','multilang');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('25', 'common', 'sys','news');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('26', 'common', 'sys','calendar');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('27', 'common', 'sys','banners');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('28', 'common', 'sys','content');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('29', 'common', 'sys','documents');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('30', 'common', 'sys','categories');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('31', 'common', 'sys','forms');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('32', 'common', 'sys','backup');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('33', 'common', 'sys','common');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('34', 'common', 'sys','install');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('35', 'common', 'sys','registration');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('36', 'common', 'sys','security');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('37', 'common', 'sys','actionLogs');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('38', 'common', 'sys','affiliates');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('39', 'common', 'sys','modules');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('40', 'common', 'sys','import');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('41', 'common', 'sys','newsletters');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('42', 'common', 'sys','segmentation');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('43', 'common', 'sys','surveys');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('44', 'common', 'sys','catalog');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('45', 'common', 'sys','orders');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('46', 'common', 'sys','projects');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('47', 'common', 'sys','objectives');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('48', 'common', 'sys','processes');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('49', 'common', 'sys','indicators');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('50', 'common', 'sys','activities');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('51', 'common', 'sys','milestones');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('52', 'common', 'sys','panel');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('53', 'common', 'sys','regions');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('54', 'common', 'sys','positions');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('55', 'common', 'sys','tenures');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('56', 'common', 'sys','issues');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('57', 'common', 'sys','headlines');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('58', 'common', 'sys','actors');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('59', 'common', 'sys','campaigns');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('60', 'common', 'sys','medias');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('61', 'common', 'sys','board');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('62', 'common', 'sys','services');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('63', 'common', 'sys','blog');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('1', 'system', 'sys','system');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('2', 'system', 'sys','parameters');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('3', 'system', 'sys','debugMode');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('4', 'system', 'sys','developmentMode');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('5', 'system', 'sys','mailCapture');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('6', 'system', 'sys','underMaintenance');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('7', 'system', 'sys','maintenanceMessage');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('8', 'system', 'sys','affiliateUserLoginUnified');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('9', 'system', 'sys','applicationTimeZoneGMT');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('10', 'system', 'sys','dateFormat');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('11', 'system', 'sys','thousandsSeparator');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('12', 'system', 'sys','decimalSeparator');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('13', 'system', 'sys','numberOfDecimals');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('14', 'system', 'sys','siteName');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('15', 'system', 'sys','siteDescription');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('16', 'system', 'sys','siteShortName');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('17', 'system', 'sys','webmasterMail');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('18', 'system', 'sys','debugMail');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('19', 'system', 'sys','fromEmail');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('20', 'system', 'sys','tablePrefix');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('21', 'system', 'sys','news');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('22', 'system', 'sys','affiliateNews');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('23', 'system', 'sys','errorReporting');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('24', 'system', 'sys','noCheckPermissionActions');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('25', 'system', 'sys','noCheckLoginActions');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('26', 'system', 'sys','rowsPerPage');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('27', 'system', 'sys','language');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('28', 'system', 'sys','fileBrowser');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('29', 'system', 'sys','directories');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('30', 'system', 'sys','dir_1');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('31', 'system', 'sys','title');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('32', 'system', 'sys','path');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('33', 'system', 'sys','dir_2');
INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('34', 'system', 'sys','dir_3');
