<div id="mainMenuH">
	<nav>
		<ul class="menu">
|-if !empty($loginUser)-|
	|-if $SESSION.firstLogin-|
			<li><a href="Main.php?do=usersPasswordChange&firstLogin=firstLogin">Actualice su clave</a></li>
			|-if !empty($loginUser)-|
				<li><a href="Main.php?do=usersDoLogout" onClick='return window.confirm("Si ya actualizó su clave, puede proceder a salir del sistema. ¿Esta seguro que quiere salir del sistema?")'>Salir</a></li>
			|-else-|
				<li><a href="Main.php?do=affiliatesUsersDoLogout" onClick='return window.confirm("Si ya actualizó su clave, puede proceder a salir del sistema. ¿Esta seguro que quiere salir del sistema?")'>Salir</a></li>
			|-/if-|				
	|-else-|
			<li><a href="Main.php?do=usersWelcome">Ir al Inicio</a></li>
		|-if $loginUser->isAdmin() || $loginUser->isSupervisor()-|		
			<li><a href="#" class="sub">Tablero</a>
			<ul class="menu">
<!--				<li><a href="Main.php?do=contentList">Contenidos</a></li>
				<li><a href="Main.php?do=documentsList">Publicaciones</a></li>
				<li><a href="Main.php?do=calendarEventsList">Eventos</a></li>
				<li><a href="Main.php?do=newsArticlesList">Novedades</a></li>
				<li class="last"><a href="backoffice/main.php">Back-office</a></li> -->
				<li><a href="Main.php?do=objectivesPolicyGuidelinesList">Ejes de Gestión</a></li>
				<li><a href="Main.php?do=objectivesStrategicObjectivesList">Objetivos Estratégicos</a></li>
				<li><a href="Main.php?do=objectivesList">Objetivos</a></li>
				<li><a href="Main.php?do=projectsList">Proyectos</a></li>
				<li><a href="Main.php?do=positionsList">Cargos y Dependencias</a></li>
				<li><a href="Main.php?do=regionsList">CPCs y Barrios</a></li>
				<li><a href="#" class="sub">PTUBA</a>
				<ul class="menu">
					<li><a href="Main.php?do=actorsList">Actores</a></li>
					<li><a href="Main.php?do=panelContractorsList">Contratistas</a></li>
					<li><a href="Main.php?do=panelguaranteesList">Garantías</a></li>
					<li  class="last"><a href="Main.php?do=panelAdministrativeActsList">Actos Administrativos</a></li>
					</ul></li>
				<li class="last"><a href="Main.php?do=indicatorsList">Indicadores</a></li>
			</ul>
		</li>
		<li><a href="#" class="sub">Administración</a>
			<ul>
				<li><a href="Main.php?do=usersList">Usuarios</a></li>
				<li><a href="Main.php?do=usersGroupsList">Grupos de Usuarios</a></li>
				<li><a href="Main.php?do=usersLevelsList">Niveles Usuarios</a></li>
				<li><a href="Main.php?do=categoriesList">Categorías</a></li>
				<li><a href="Main.php?do=commonActionLogsList">Histórico de Operaciones</a></li>
				<li class="last"><a href="Main.php?do=backupList">Respaldos</a></li>
			</ul></li>
		|-if $loginUser->isSupervisor()-|		
		<li><a href="#" class="sub">Configuración</a>
			<ul>
				<!-- <li class="menuLink"><a href="Main.php?do=commonConfigView">Ver Configuración</a></li> -->
				<li><a href="Main.php?do=commonConfigSet">Configurar Sistema</a></li>
				<li><a href="Main.php?do=commonConfigEdit">Editar Configuración</a></li>
				<li><a href="Main.php?do=multilangLanguagesList">Idiomas</a></li>
				<li><a href="Main.php?do=multilangTextsList">Textos</a></li>		
				<li class="last"><a href="Main.php?do=multilangTextsDump&amp;moduleName=|-*$moduleName*-|">Textos SQL</a></li>			
			</ul></li>
		<li><a href="#" class="sub">Dependencias</a>
	<ul>
		<li><a href="Main.php?do=affiliatesList">Dependencias</a></li>
		<li><a href="Main.php?do=affiliatesBranchsList">Oficinas Dependencias</a></li>
		<li class="last"><a href="Main.php?do=affiliatesUsersList">Usuarios de Dependencias</a></li>
			</ul></li>
		<li><a href="#" class="sub">Tablero</a>
	<ul>
		<li><a href="Main.php?do=tableroStrategicObjectivesList">Administrar Objetivos Estratégicos</a></li>
		<li><a href="Main.php?do=tableroObjectivesList">Administrar Objetivos</a></li>
		<li><a href="Main.php?do=tableroProjectsList">Administrar Proyectos</a></li>
		<li><a href="Main.php?do=tableroDependenciesNav">Navegar Dependencias</a></li>
		<li><a href="Main.php?do=tableroStrategicObjectivesNav">Navegar Objetivos Estratégicos</a></li>
		<li><a href="Main.php?do=tableroDependenciesShow">Ver Dependencias</a></li>
		<li><a href="Main.php?do=regionsList">Administrar Localidades</a></li>
		<li><a href="Main.php?do=tableroPositionsList">Administrar Cargos</a></li>
		<li><a href="Main.php?do=tableroIndicatorsList">Administrar Indicadores/Metas</a></li>
		<li><a href="Main.php?do=tableroMeasuresList">Administrar Mediciones</a></li>
		<li><a href="Main.php?do=tableroMeasureUnitsList">Administrar Unidades de Medida</a></li>
		<li class="last"><a href="Main.php?do=indicatorsList">Administrar Indicadores</a></li>
			</ul></li>
|-/if-|
		
|-/if-|
|-/if-|
|-/if-|
|-if !empty($loginAffiliateUser)-|
  	<ul>
		<li class="menuLink"><a href="Main.php?do=affiliatesUsersWelcome">Ir al Inicio</a></li>
	</ul>
	|-if $parameters.hasUnifiedUsernames.value neq "YES"-|
		<li><a href="Main.php?do=affiliatesUsersDoLogout" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")'>Salir</a></li>
	|-else-|
		<li><a href="Main.php?do=commonDoLogout" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")'>Salir</a></li>
	|-/if-|
|-/if-|
		</ul>
	</nav>
</div>