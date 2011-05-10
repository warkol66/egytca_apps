DELETE FROM `modules_label` WHERE `name` = 'segmentation' and `language` = 'eng';
INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('segmentation', 'Segmentation', 'Manages registration users clusters', 'eng');
