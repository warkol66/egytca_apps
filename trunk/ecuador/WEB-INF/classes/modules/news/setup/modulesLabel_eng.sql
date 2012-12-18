DELETE FROM `modules_label` WHERE `name` = 'news' and `language` = 'eng';
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('news', 'News', 'News management', 'eng');
