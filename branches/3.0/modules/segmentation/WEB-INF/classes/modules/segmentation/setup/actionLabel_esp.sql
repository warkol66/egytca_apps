DELETE FROM `security_actionLabel` WHERE `action` LIKE 'Segmentation%' AND `language` = 'esp';
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('SegmentationClustersEdit', '', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('SegmentationClustersPreview', '', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('SegmentationClustersDoDelete', '', 'esp');
INSERT INTO `security_actionLabel` ( `action` , `label` , `language` ) VALUES ('SegmentationClustersList', '', 'esp');
