|-if !empty($loginUser)-|
	|-if $SESSION.firstLogin-|
	<ul>
			<li><a href="Main.php?do=usersPasswordChange&firstLogin=firstLogin">Actualice su clave</a></li>
	</ul>
	<a href="Main.php?do=|-if ($configModule->get("global","unifiedUsernames"))-|commonDoLogout|-else-|usersDoLogout|-/if-|" onClick='return window.confirm("Si ya actualizó su clave, puede proceder a salir del sistema. ¿Esta seguro que quiere salir del sistema?")' id="logout">Salir del Sistema</a>
	|-else-|
	<ul>
		<li><a href="Main.php?do=usersWelcome">Ir al Inicio</a></li>

		<li class="titleMenu" onclick="$('sectionApplications').toggle()">Aplicaciones</li>
		<div id="sectionApplications" style="display:|-if $module|upper eq 'ISSUES' || $module|upper eq 'ACTORS' || $module|upper eq 'HEADLINES' || $module|upper eq 'CAMPAIGNS'-|block|-else-|none|-/if-|">
			<li><a href="Main.php?do=actorsList">Actores</a></li>
			<li><a href="Main.php?do=issuesList">Asuntos</a></li>
			<li><a href="Main.php?do=headlinesList">Titulares</a></li>
			<li><a href="Main.php?do=campaignsList">Campañas</a></li>
		</div>

		<li class="titleMenu" onclick="$('sectionConfigurations').toggle()">Configuración</li>
		<div id="sectionConfigurations" style="display:|-if $module|upper eq 'CLIENTS' || $module|upper eq 'MEDIAS'-|block|-else-|none|-/if-|">
			<li><a href="Main.php?do=mediasTypeList">Tipo de medios</a></li>
			<li><a href="Main.php?do=mediasAudienceList">Audiencias</a></li>
			<li><a href="Main.php?do=mediasMarketList">Mercados</a></li>

			<li><a href="Main.php?do=actorsCategoryList">Categorías de actores</a></li>
			<li><a href="Main.php?do=issuesCategoryList">Categorías de asuntos</a></li>

			<li><a href="Main.php?do=mediasList">Medios</a></li>
			<li><a href="Main.php?do=clientsList">Clientes</a></li>
			<li><a href="Main.php?do=clientsUsersList">Usuarios de Clientes</a></li>
		</div>

		<li class="titleMenu" onclick="$('sectionAdmin').toggle()">Administración</li>
		<div id="sectionAdmin" style="display:|-if $module|upper eq 'USERS' || $module|upper eq 'AFFILIATES' || $module|upper eq 'MODULES' 
		|| $module|upper eq 'COMMON' || $module|upper eq 'SURVEYS' || $module|upper eq 'SECURITY'-|block|-else-|none|-/if-|">
			<li><a href="Main.php?do=affiliatesList">##affiliates,1,Afiliados##</a></li>
			<li><a href="Main.php?do=affiliatesBranchesList">##affiliates,5,Sucursales##</a></li>
			<li><a href="Main.php?do=affiliatesUsersList">##affiliates,2,Usuarios del afiliado##</a></li>
			<li><a href="Main.php?do=commonConfigSet">Cambiar Configuración</a></li>
			<li><a href="Main.php?do=commonConfigEdit">Editar Configuración</a></li>
			<li><a href="Main.php?do=commonConfigView">Ver Configuración</a></li>
			<li><a href="Main.php?do=backupList">Respaldos</a></li>
			<li><a href="Main.php?do=usersList">Usuarios</a></li>
			<li><a href="Main.php?do=usersLevelsList">Administrar Niveles de Usuario</a></li>
			<li><a href="Main.php?do=usersGroupsList">Administrar Grupos de Usuarios</a></li>
			<li><a href="Main.php?do=modulesList">Administrar módulos</a></li>
			<li><a href="Main.php?do=modulesInstallList">Instalar Modulos</a></li>
		|-if $loginUser->isSupervisor()-|
			<li><a href="Main.php?do=securityEditPermissions">Administrar Permisos</a></li>
		|-/if-|
		</div>
	</ul>

	<a href="Main.php?do=|-if ($configModule->get("global","unifiedUsernames"))-|commonDoLogout|-else-|usersDoLogout|-/if-|" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")' id="logout">Salir del Sistema</a>
	|-/if-|
|-else if !empty($loginAffiliateUser)-|
	|-if $SESSION.firstLogin-|
		<ul>
			<li><a href="Main.php?do=affiliatesUsersPasswordChange&firstLogin=firstLogin">Actualice su clave</a></li>
		</ul>
		<a href="Main.php?do=|-if ($configModule->get("global","unifiedUsernames"))-|commonDoLogout|-else-|affiliatesUsersDoLogout|-/if-|" onClick='return window.confirm("Si ya actualizó su clave, puede proceder a salir del sistema. ¿Esta seguro que quiere salir del sistema?")' id="logout">Salir del Sistema</a>
	|-else-|
	<ul>
		<li class="menuLink"><a href="Main.php?do=affiliatesUsersWelcome">Ir al Inicio</a></li>
		<li class="titleMenu" onclick="switch_vis('sectionAdmin')">Administración</li>
		<div id="sectionAdmin" style="display:|-if $module|upper eq "AFFILIATES" || $module|upper eq "SURVEYS"-|block|-else-|none|-/if-|">
			<li><a href="Main.php?do=affiliatesUsersList">Administrar Usuarios</a></li>
			<li><a href="Main.php?do=affiliatesBranchesList">Administrar ##affiliates,5,Sucursales##</a></li>
		</div>
	</ul>
	<a href="Main.php?do=|-if ($configModule->get("global","unifiedUsernames"))-|commonDoLogout|-else-|affiliatesUsersDoLogout|-/if-|" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")' id="logout">Salir del Sistema</a>
	|-/if-|
|-/if-|
