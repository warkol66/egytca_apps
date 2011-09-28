--
-- Initial data module "users"
--

--
-- Data for table `users_user`
--

INSERT INTO `users_user` (`id`, `username`, `password`, `passwordUpdated`, `active`, `levelId`, `name`, `surname`) VALUES
(-1, 'system', 'e2c09ea5f00d3a54f103dcfaa4dfbb4e', '2001-01-01', 1, 1, 'System', 'System'),
(1, 'supervisor', 'd40a4afe38b91cf04bdecc71bf4db659', '2001-01-01', 1, 1, 'Supervisor', 'Supervisor'),
(2, 'admin', '45c48d97153f26e17d101be744368331', '2001-01-01', 1, 2, 'Admin', 'Admin');

--
-- Data for table `users_level`
--

INSERT INTO `users_level` (`id`, `name`, `bitLevel`) VALUES
(1, 'Supervisor', 1),
(2, 'Administrador', 2),
(3, 'Usuario Administrativo', 4),
(4, 'Usuario', 8);

--
-- Data for table `users_group`
--

INSERT INTO `users_group` (`id`, `name`, `created`, `updated`, `bitLevel`) VALUES
(1, 'supervisor', '2001-01-01 00:00:00', '2001-01-01 00:00:00', NULL),
(2, 'admin', '2001-01-01 00:00:00', '2001-01-01 00:00:00', NULL);

--
-- Data for table `users_userGroup`
--

INSERT INTO `users_userGroup` (`userId`, `groupId`) VALUES
(1, 1),
(1, 2),
(2, 2);
