|-if !empty($loginUser)-|
	|-if $SESSION.firstLogin-|
	<ul>
			<li><a href="Main.php?do=usersPasswordChange&firstLogin=firstLogin">Actualice su clave</a></li>
	</ul>
	<a href="Main.php?do=|-if ($configModule->get("global","unifiedUsernames"))-|commonDoLogout|-else-|usersDoLogout|-/if-|" onClick='return window.confirm("Si ya actualizó su clave, puede proceder a salir del sistema. ¿Esta seguro que quiere salir del sistema?")' id="logout">Salir del Sistema</a>
	|-else-|
	<ul class="nav">
		<li><a href="Main.php?do=usersWelcome">Ir al Inicio</a></li>

		<li class="medium"><a href="#" onclick="$('#sectionConfigurations, #sectionAdmin').hide();$('#sectionApplications').toggle()">Aplicaciones</a>
			<ul id="sectionApplications" class="in_nav" style="display:|-if $module|upper eq 'CONTENT' || $module|upper eq 'BLOG' || $module|upper eq 'REGISTRATION' || $module|upper eq 'DOCUMENTS'-|block|-else-|none|-/if-|">
				<li><a href="Main.php?do=blogList">Blog</a></li>
				<li><a href="Main.php?do=contentList">Contenidos</a></li>
				<li><a href="Main.php?do=registrationList">Usuarios registrados</a></li>
				<li><a href="Main.php?do=documentsList">Documentos</a></li>
			</ul>
		</li>

		<li class="large"><a href="#" onclick="$('#sectionApplications, #sectionAdmin').hide();$('#sectionConfigurations').toggle()">Configuración</a>
			<ul id="sectionConfigurations" class="in_nav" style="display:|-if $module|upper eq 'CLIENTS' || $module|upper eq 'MEDIAS'-|block|-else-|none|-/if-|">
				<li><a href="Main.php?do=mediasTypeList">Tipo de medios</a></li>
				<li><a href="Main.php?do=mediasAudienceList">Audiencias</a></li>
				<li><a href="Main.php?do=mediasMarketList">Mercados</a></li>

				<li><a href="Main.php?do=actorsCategoryList">Categorías de actores</a></li>
				<li><a href="Main.php?do=issuesCategoryList">Categorías de asuntos</a></li>

				<li><a href="Main.php?do=mediasList">Medios</a></li>
				<li><a href="Main.php?do=clientsList">Clientes</a></li>
				<li><a href="Main.php?do=clientsUsersList">Usuarios de Clientes</a></li>
			</ul>
		</li>

		<li class="large"><a href="#" onclick="$('#sectionApplications, #sectionConfigurations').hide();$('#sectionAdmin').toggle()">Administración</a></li>
			<ul id="sectionAdmin" class="in_nav" style="display:|-if $module|upper eq 'USERS' || $module|upper eq 'AFFILIATES' || $module|upper eq 'MODULES' 
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
			</ul>
		</li>
		<li><a href="Main.php?do=|-if ($configModule->get("global","unifiedUsernames"))-|commonDoLogout|-else-|usersDoLogout|-/if-|" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")' >Salir del Sistema</a></li>
	</ul>

	
	|-/if-|
|-elseif !empty($loginAffiliateUser)-|
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
