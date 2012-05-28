-- --------------------------------------------------------

-- 
-- Init data for users module
-- 

-- --------------------------------------------------------

-- 
-- Init data for table `users_user`
-- 

INSERT INTO `users_user` (`id`, `username`, `name`, `surname`, `password`, `active`, `created`, `updated`, `levelId`, `lastLogin`) VALUES 
(1, 'supervisor', 'Supervisor', 'Supervisor', 'd40a4afe38b91cf04bdecc71bf4db659', 1, '2001-01-01 00:00:00', '2001-01-01 00:00:00', 1, '2001-01-01 00:00:00'),
(2, 'admin', 'Admin', 'Admin', '45c48d97153f26e17d101be744368331', 1, '2001-01-01 00:00:00', '2001-01-01 00:00:00', 2, '2001-01-01 00:00:00');

-- 
-- Init data for table `users_userInfo`
-- 

INSERT INTO `users_userInfo` (`userId`, `name`, `surname`, `mailAddress`) VALUES 
(1, 'Supervisor', 'Supervisor', ''),
(2, 'Admin', 'Admin', '');

-- 
-- Init data for table `users_level`
-- 

INSERT INTO `users_level` (`id`, `name`, `bitLevel`) VALUES 
(1, 'Supervisor', 1),
(2, 'Administrador', 2),
(3, 'Usuario', 4);

-- 
-- Init data for table `users_group`
-- 

INSERT INTO `users_group` (`id`, `name`, `created`, `updated`, `bitLevel`) VALUES 
(1, 'supervisor', '2001-01-01 00:00:00', '2001-01-01 00:00:00', NULL),
(2, 'admin', '2001-01-01 00:00:00', '2001-01-01 00:00:00', NULL);

-- 
-- Init data for table `users_userGroup`
-- 

INSERT INTO `users_userGroup` (`userId`, `groupId`) VALUES 
(1, 1),
(1, 2),
(2, 2);


INSERT INTO `users_user` (`id`, `username`, `password`, `active`, `levelId`, `lastLogin`, `timezone`, `passwordUpdated`, `recoveryHash`, `recoveryHashCreatedOn`, `name`, `surname`, `mailAddress`, `mailAddressAlt`, `deleted_at`, `created_at`, `updated_at`) VALUES
(-1, 'system', '45c48g97153f26e17d101be744368331', 1, 1, NOW(), '', NOW(), NULL, NULL, 'System', 'System', '', NULL, NULL, NOW(), NOW());



