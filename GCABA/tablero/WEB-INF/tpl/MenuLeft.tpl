|-if !empty($loginUser)-|
	<ul>
		<li class="menuLink"><a href="Main.php?do=usersWelcome">Ir al Inicio</a></li>
	</ul>
	<ul>
		<li class="titleMenu"><a href="javascript:switch_vis('applicationMenu');" class="linkSwitchMenu">Aplicaciones</a></li>
	</ul>
		<div id="applicationMenu" style="display:|-if $module|lower eq 'documents' || $module|lower eq 'content' || $module|lower eq 'news' || $module|lower eq 'calendar'-|block|-else-|none|-/if-|;">
			<ul>
		|-if $loginUser->isAdmin()-|		
				<li class="menuLink"><a href="Main.php?do=contentList">Contenidos</a></li>
				<li class="menuLink"><a href="Main.php?do=documentsList">Publicaciones</a></li>
				<li class="menuLink"><a href="Main.php?do=calendarEventsList">Eventos</a></li>
				<li class="menuLink"><a href="Main.php?do=newsArticlesList">Novedades</a></li>
				<li class="menuLink"><a href="backoffice/main.php">Back-office</a></li>
		|-/if-|
			</ul>
		</div>
|-if $loginUser->isAdmin()-|		
|-if ("bannersClientsList"|security_user_has_access) || ("bannersZonesList"|security_user_has_access) || ("bannersList"|security_user_has_access)-|
	<ul>
		<li class="titleMenu"><a href="javascript:switch_vis('bannersMenu');" class="linkSwitchMenu">Banners</a></li>
	</ul>
		<div id="bannersMenu" style="display:|-if $module|lower eq 'banners'-|block|-else-|none|-/if-|;">
			<ul>
				|-if "bannersClientsList"|security_user_has_access-|<li class="menuLink"><a href="Main.php?do=bannersClientsList">Administrar Clientes</a></li>|-/if-|
				|-if "bannersZonesList"|security_user_has_access-|<li class="menuLink"><a href="Main.php?do=bannersZonesList">Administrar Zonas</a></li>|-/if-|
				|-if "bannersList"|security_user_has_access-|<li class="menuLink"><a href="Main.php?do=bannersList">Administrar Banners</a></li>|-/if-|
			</ul>
		</div>
|-/if-|
|-if ("formsFormsList"|security_user_has_access) || ("formsProcessedFormsList"|security_user_has_access)-|
	<ul>
		<li class="titleMenu"><a href="javascript:switch_vis('formsMenu');" class="linkSwitchMenu">Formularios</a></li>
	</ul>
		<div id="formsMenu" style="display:|-if $module|lower eq 'forms'-|block|-else-|none|-/if-|;">
			<ul>
				|-if "formsFormsList"|security_user_has_access-|<li class="menuLink"><a href="Main.php?do=formsFormsList">Formularios</a></li>|-/if-|
				|-if "formsProcessedFormsList"|security_user_has_access-|<li class="menuLink"><a href="Main.php?do=formsProcessedFormsList">Respuestas</a></li>|-/if-|
			</ul>
		</div>
|-/if-|
	<ul>
		<li class="titleMenu"><a href="javascript:switch_vis('adminMenu');" class="linkSwitchMenu">Administración</a></li>
	</ul>
		<div id="adminMenu" style="display:|-if $module|lower eq 'users' || $module|lower eq 'security' || $module|lower eq 'backups' || $module|lower eq 'affiliates' || $module|lower eq 'categories' || $module|lower eq 'backup' || ($module|lower eq 'import' && ($section|lower eq 'products' || $section|lower eq 'suppliers' || $section|lower eq 'ports' || $section|lower eq 'incoterms'))-|block|-else-|none|-/if-|;">
			<ul>
				<li class="menuLink"><a href="Main.php?do=usersList">Usuarios</a></li>
				<li class="menuLink"><a href="Main.php?do=usersGroupsList">Grupos de Usuarios</a></li>
				<li class="menuLink"><a href="Main.php?do=usersLevelsList">Niveles Usuarios</a></li>
				<li class="menuLink"><a href="Main.php?do=categoriesList">Categorías</a></li>
				<li class="menuLink"><a href="Main.php?do=backupList">Respaldos</a></li>
			</ul>
		</div>
	<ul>
		<li class="titleMenu"><a href="javascript:switch_vis('configMenu');" class="linkSwitchMenu">Configuración</a></li>
	</ul>
		<div id="configMenu" style="display:|-if $module|lower eq 'config' || $module|lower eq 'multilang'-|block|-else-|none|-/if-|;">
			<ul>
				<!-- <li class="menuLink"><a href="Main.php?do=configView">Ver Configuración</a></li> -->
				<li class="menuLink"><a href="Main.php?do=configSet">Configurar Sistema</a></li>
				<li class="menuLink"><a href="Main.php?do=configEdit">Editar Configuración</a></li>
				<li class="menuLink"><a href="Main.php?do=multilangLanguagesList">Idiomas</a></li>
				<li class="menuLink"><a href="Main.php?do=multilangTextsList">Textos</a></li>		
				<li class="menuLink"><a href="Main.php?do=multilangTextsDump&amp;moduleName=|-*$moduleName*-|">Textos SQL</a></li>			
			</ul>
		</div>
	<ul>
		<li class="titleMenu"><a href="javascript:switch_vis('dependenciasMenu');" class="linkSwitchMenu">Dependencias</a></li>
	</ul>
		<div id="dependenciasMenu" style="display:|-if $module|lower eq 'affiliates'-|block|-else-|none|-/if-|;">
		<li class="menuLink"><a href="Main.php?do=affiliatesList">Dependencias</a></li>
		<li class="menuLink"><a href="Main.php?do=affiliatesBranchsList">Oficinas Dependencias</a></li>
		<li class="menuLink"><a href="Main.php?do=affiliatesUsersList">Usuarios de Dependencias</a></li>
			</ul>
		</div>
	<ul>
		<li class="titleMenu"><a href="javascript:switch_vis('tableroMenu');" class="linkSwitchMenu">Tablero</a></li>
	</ul>
		<div id="tableroMenu" style="display:|-if $module|lower eq 'tablero' or $module|lower eq 'regions' or $module|lower eq 'indicators'-|block|-else-|none|-/if-|;">
		<li class="menuLink"><a href="Main.php?do=tableroStrategicObjectivesList">Administrar Objetivos Estratégicos</a></li>
		<li class="menuLink"><a href="Main.php?do=tableroObjectivesList">Administrar Objetivos</a></li>
		<li class="menuLink"><a href="Main.php?do=tableroProjectsList">Administrar Proyectos</a></li>
		<li class="menuLink"><a href="Main.php?do=tableroDependenciesNav">Navegar Dependencias</a></li>
		<li class="menuLink"><a href="Main.php?do=tableroStrategicObjectivesNav">Navegar Objetivos Estratégicos</a></li>
		<li class="menuLink"><a href="Main.php?do=tableroDependenciesShow">Ver Dependencias</a></li>
		<li class="menuLink"><a href="Main.php?do=regionsList">Administrar Localidades</a></li>
		<li class="menuLink"><a href="Main.php?do=tableroPositionsList">Administrar Cargos</a></li>
		<li class="menuLink"><a href="Main.php?do=tableroIndicatorsList">Administrar Indicadores/Metas</a></li>
		<li class="menuLink"><a href="Main.php?do=tableroMeasuresList">Administrar Mediciones</a></li>
		<li class="menuLink"><a href="Main.php?do=tableroMeasureUnitsList">Administrar Unidades de Medida</a></li>
		<li class="menuLink"><a href="Main.php?do=indicatorsList">Administrar Indicadores</a></li>
		
		
			</ul>
		</div>
		
|-/if-|
	|-if $parameters.hasUnifiedUsernames.value neq "YES"-|
		<a href="Main.php?do=usersDoLogout" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")' id="logout"></a>
	|-else-|
		<a href="Main.php?do=commonDoLogout" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")' id="logout"></a>
	|-/if-|
|-/if-|
|-if $loginAffiliateUser neq ""-|
  	<ul>
		<li class="menuLink"><a href="Main.php?do=affiliatesUsersWelcome">Ir al Inicio</a></li>
	</ul>
	<ul>
		<li class="titleMenu"><a href="javascript:switch_vis('importAffiliateMenu');" class="linkSwitchMenu">Importaciones</a></li>
  	</ul>
	<div id="importAffiliateMenu">
		<ul>
			<li class="menuLink"><a href="Main.php?do=importClientQuoteList">Cotizaciones</a></li>
			<li class="menuLink"><a href="Main.php?do=importClientOrderList">Pedidos</a></li>
		</ul>
	</div>

	|-if $parameters.hasUnifiedUsernames.value neq "YES"-|
		<a href="Main.php?do=affiliatesUsersDoLogout" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")' id="logout"></a>
	|-else-|
		<a href="Main.php?do=commonDoLogout" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")' id="logout"></a>
	|-/if-|
|-/if-|
