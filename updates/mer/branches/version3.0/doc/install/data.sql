insert into MER_form (id,name) values (null, 'Form');
insert into MER_formSection values (null,null,0,"Section");
update MER_form set rootSectionId=LAST_INSERT_ID();
INSERT INTO `users_group` (`name` , `created` , `updated` ) VALUES ('admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `users_group` (`name` , `created` , `updated` ) VALUES ('supervisor', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `users_user` (`username` , `password` , `active` , `created` , `updated` ) VALUES ('admin', '45c48d97153f26e17d101be744368331', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `users_user` (`username` , `password` , `active` , `created` , `updated` ) VALUES ('supervisor', '45c48d97153f26e17d101be744368331', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `users_usergroup` ( `userId` , `groupId` ) VALUES ('1', '1');
INSERT INTO `users_usergroup` ( `userId` , `groupId` ) VALUES ('2', '1');
INSERT INTO `users_usergroup` ( `userId` , `groupId` ) VALUES ('2', '2');
INSERT INTO `users_userinfo` ( `userId` , `name` , `surname` ) VALUES ('1', 'Admin', 'Admin');
INSERT INTO `users_userinfo` ( `userId` , `name` , `surname` ) VALUES ('2', 'Supervisor', 'Supervisor');

