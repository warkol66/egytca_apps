|-if !empty($loginUser)-|
	<ul>
		<li class="menuLink"><a href="Main.php?do=usersWelcome">Ir al Inicio</a></li>
		<li class="menuLink"><a href="Main.php?do=calendarShow" target="_blank">Ver Agenda</a></li>
		<li class="titleMenu" onclick="switch_vis('sectionAgenda')">Agenda</li>
		<div id="sectionAgenda" style="display:|-if $module|upper eq "CALENDAR"-|block|-else-|none|-/if-|">
			<li><a href="Main.php?do=calendarEventsList">Administrar Agenda</a></li>
			<li><a href="Main.php?do=calendarContextEventsList">Administrar Contexto</a></li>
			<li><a href="Main.php?do=calendarHolidayEventsList">Administrar Feriados</a></li>
			<li><a href="Main.php?do=calendarRegularEventList">Administrar Efemérides</a></li>
		</div>
		<li class="titleMenu" onclick="switch_vis('sectionConstructions')">Obras</li>
		<div id="sectionConstructions" style="display:|-if $module|upper eq 'CONSTRUCTIONS'-|block|-else-|none|-/if-|">
			<li><a href="Main.php?do=constructionsList">Obras</a></li>
		</div>
		<li class="titleMenu" onclick="switch_vis('sectionConfig')">Configuración</li>
		<div id="sectionConfig" style="display:|-if $module|upper eq 'CALENDAR' || $module|upper eq 'CATEGORIES' || $module|upper eq 'MODULES' 
		|| $module|upper eq 'ACTORS'-|block|-else-|none|-/if-|">
			<li><a href="Main.php?do=actorsList">Funcionarios</a></li>
			<li><a href="Main.php?do=categoriesList">Dependencias</a></li>
			<li><a href="Main.php?do=calendarAxisList">Ejes de Gestión</a></li>
		</div>
		<li class="titleMenu" onclick="switch_vis('sectionAdmin')">Administración</li>
		<div id="sectionAdmin" style="display:|-if $module|upper eq 'USERS' || $module|upper eq 'AFFILIATES' || $module|upper eq 'MODULES' 
		|| $module|upper eq 'COMMON' || $module|upper eq 'SURVEYS' || $module|upper eq 'SECURITY'-|block|-else-|none|-/if-|">
			<li><a href="Main.php?do=commonConfigSet">Cambiar Configuración</a></li>
			<li><a href="Main.php?do=commonConfigEdit">Editar Configuración</a></li>
			<li><a href="Main.php?do=commonConfigView">Ver Configuración</a></li>
			<li><a href="Main.php?do=backupList">Respaldos</a></li>
			<li><a href="Main.php?do=usersList">Usuarios</a></li>
			<li><a href="Main.php?do=usersLevelsList">Administrar Niveles de Usuario</a></li>
			<li><a href="Main.php?do=usersGroupsList">Administrar Grupos de Usuarios</a></li>
			<li><a href="Main.php?do=modulesList">Administrar módulos</a></li>
			<li><a href="Main.php?do=modulesInstallList">Instalar Modulos</a></li>
			<li><a href="Main.php?do=surveysList">Administrar Encuestas</a></li>
|-if $loginUser->isSupervisor()-|
			<li><a href="Main.php?do=securityEditPermissions">Administrar Permisos</a></li>
|-/if-|
		</div>
	</ul>
	<a href="Main.php?do=|-if ($configModule->get("global","unifiedUsernames"))-|commonDoLogout|-else-|usersDoLogout|-/if-|" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")' id="logout"></a>
|-else if !empty($loginAffiliateUser)-|
	<ul>
		<li class="menuLink"><a href="Main.php?do=usersWelcome">Ir al Inicio</a></li>
		<li class="menuLink"><a href="Main.php?do=calendarEventsShow">Ver Agenda</a></li>
		<li class="titleMenu" onclick="switch_vis('sectionOrders')">Agenda</li>
		<div id="sectionOrders" style="display:|-if $module|upper eq "CALENDAR"-|block|-else-|none|-/if-|">
			<li><a href="Main.php?do=calendarEventsList">Administrar Agenda</a></li>
		</div>
		<li class="titleMenu" onclick="switch_vis('sectionAdmin')">Administración</li>
		<div id="sectionAdmin" style="display:|-if $module|upper eq "AFFILIATES" || $module|upper eq "SURVEYS"-|block|-else-|none|-/if-|">
			<li><a href="Main.php?do=affiliatesUsersList">Administrar Usuarios</a></li>
			<li><a href="Main.php?do=affiliatesBranchsList">Administrar ##affiliates,5,Sucursales##</a></li>
		</div>
	</ul>
	<a href="Main.php?do=|-if ($configModule->get("global","unifiedUsernames"))-|commonDoLogout|-else-|affiliatesUsersDoLogout|-/if-|" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")' id="logout"></a>
|-/if-|