DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Segmentation%' AND `language` = 'eng';
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('SegmentationClustersEdit', '', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('SegmentationClustersPreview', '', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('SegmentationClustersDoDelete', '', 'eng');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('SegmentationClustersList', '', 'eng');
