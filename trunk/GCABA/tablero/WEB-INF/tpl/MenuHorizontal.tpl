<div id="mainMenuH">
	<nav>
		<ul class="menu">
|-if !empty($loginUser)-|
	|-if $smarty.session.firstLogin-|
			<li><a href="Main.php?do=usersPasswordChange&firstLogin=firstLogin">Actualice su clave</a></li>
			|-if !empty($loginUser)-|
				<li><a href="Main.php?do=usersDoLogout" onClick='return window.confirm("Si ya actualizó su clave, puede proceder a salir del sistema. ¿Está seguro que quiere salir del sistema?")'>Salir</a></li>
			|-else-|
				<li><a href="Main.php?do=affiliatesUsersDoLogout" onClick='return window.confirm("Si ya actualizó su clave, puede proceder a salir del sistema. ¿Está seguro que quiere salir del sistema?")'>Salir</a></li>
			|-/if-|				
	|-else-|
			<li><a href="Main.php?do=usersWelcome" class="sub">Ir al Inicio</a>
			|-if $loginUser->mayPlan() || $loginUser->mayFollow()-|<ul class="menu">
				<li class="last">|-if !$smarty.session.panelMode-|<a href="Main.php?do=panelSetPanel">Cambiar a Modo Seguimiento</a>|-else-|<a href="Main.php?do=planningSetPlanning">Cambiar a Modo Planeamiento</a>|-/if-|</li>
			</ul>|-/if-|
		</li>
			<li><a href="#" class="sub">Objetivos</a>
			  <ul class="menu">
				<li><a href="Main.php?do=planningImpactObjectivesList">Objetivos de Impacto</a></li>
				<li><a href="Main.php?do=planningMinistryObjectivesList">Objetivos Ministeriales</a></li>
				<li class="last"><a href="Main.php?do=planningOperativeObjectivesList">Objetivos Operativos</a></li>
			</ul>
		</li>
			<li><a href="javascript:void(null)" class="sub">Planificación</a>
			  <ul class="menu">
				<li><a href="Main.php?do=planningProjectsList">Proyectos</a></li>
				<li><a href="Main.php?do=planningConstructionsList">Obras</a></li>
				<li class="last"><a href="Main.php?do=planningActivitiesList">Actividades</a></li>
			</ul>
		</li>
			|-if $loginUser->isSupervisor() || $loginUser->mayFollow()-|<li><a href="javascript:void(null)" class="sub">Seguimiento</a>
			  <ul class="menu">
				<li><a href="Main.php?do=panelProjectsList">Proyectos</a></li>
				<li><a href="Main.php?do=panelConstructionsList">Obras</a></li>
				<li class="last"><a href="Main.php?do=panelActivitiesList">Actividades</a></li>
				<li><a href="Main.php?do=panelResultsGraphShow">Vision estratégica</a></li>
				<li><a href="Main.php?do=panelResultsShow">Indicadores de resultado</a></li>
				<li><a href="Main.php?do=panelExpensesShow">Gasto</a></li>
				<li><a href="Main.php?do=panelRelativeExpensesShow">Gasto relativo</a></li>
				<li class="last"><a href="Main.php?do=panelExpensesShareShow">Participación del Gasto</a></li>
			</ul>
		</li>|-/if-|
			<li><a href="Main.php?do=planningIndicatorsList">Indicadores</a>
			</li>
		|-if $loginUser->isAdmin() || $loginUser->isSupervisor()-|		
			<li><a href="javascript:void(null)" class="sub">Organización</a>
			  <ul class="menu">
				<li><a href="Main.php?do=actorsList">Funcionarios</a></li>
				<li><a href="Main.php?do=positionsList">Cargos y Dependencias</a></li>
				<li class="last"><a href="Main.php?do=regionsList">Comunas y Barrios</a></li>
			</ul>
			</li>
		</li>
		<li><a href="javascript:void(null)" class="sub">Administración</a>
			<ul>
				<li><a href="Main.php?do=usersList">Usuarios</a></li>
				<li><a href="Main.php?do=usersGroupsList">Grupos de Usuarios</a></li>
				<li><a href="Main.php?do=usersLevelsList">Niveles Usuarios</a></li>
				<li class="last"><a href="Main.php?do=planningProjectTagsList">Etiquetas de Proyectos</a></li>
				<!--<li><a href="Main.php?do=categoriesList">Categorías</a></li>-->
				<li><a href="Main.php?do=commonActionLogsList">Histórico de Operaciones</a></li>
				<li class="last"><a href="Main.php?do=backupList">Respaldos</a></li>
			</ul></li>
			|-if $loginUser->isSupervisor()-|		
			<li><a href="javascript:void(null)" class="sub">Configuración</a>
				<ul>
					<li><a href="Main.php?do=securityEditPermissions">Administrar permisos</a></li>
					<li><a href="Main.php?do=usersPasswordChange">Actualice su contraseña</a></li>
					<li><a href="Main.php?do=commonConfigSet">Configurar Sistema</a></li>
					<li><a href="Main.php?do=commonMeasureUnitsList">Unidades de Medida</a></li>
					<li><a href="Main.php?do=commonConfigEdit">Editar Configuración</a></li>
					<li class="last"><a href="javascript:void(null)">Utilidades</a>
					<ul>
						<li class="last"><a href="Main.php?do=commonChecksum">Checksum de Tablas</a></li>
					</ul></li>
				</ul></li>
			|-/if-|		
		|-else-|
		<li><a href="javascript:void(null)" class="sub">Configuración</a>
			<ul>
				<li class="last"><a href="Main.php?do=usersPasswordChange">Actualice su contraseña</a></li>
			</ul></li>
		|-/if-|
	|-/if-|
			<li><a href="javascript:void(null)" class="sub">Tutoriales</a>
			<ul>
				<li><a href="javascript:void(null);" onClick="window.open('Main.php?do=commonTutorialView&fileName=1_Bienvenida.wmv','tutorial','width=900,height=640,toolbar=no,status=yes,menubar=no,scrollbars=no')">1 Bienvenida</a></li>
				<li><a href="javascript:void(null);" onClick="window.open('Main.php?do=commonTutorialView&fileName=2_CrearObjetivoDeImpacto.wmv','tutorial','width=900,height=640,toolbar=no,status=yes,menubar=no,scrollbars=no')">2 Crear Objetivo de Impacto</a></li>
				<li><a href="javascript:void(null);" onClick="window.open('Main.php?do=commonTutorialView&fileName=3_CrearObjetivoMinisterial.wmv','tutorial','width=900,height=640,toolbar=no,status=yes,menubar=no,scrollbars=no')">3 Crear Objetivo Ministerial</a></li>
				<li><a href="javascript:void(null);" onClick="window.open('Main.php?do=commonTutorialView&fileName=4_CrearObjetivoOperativo.wmv','tutorial','width=900,height=640,toolbar=no,status=yes,menubar=no,scrollbars=no')">4 Crear Objetivo Operativo</a></li>
				<li><a href="javascript:void(null);" onClick="window.open('Main.php?do=commonTutorialView&fileName=5_CrearProyecto.wmv','tutorial','width=900,height=640,toolbar=no,status=yes,menubar=no,scrollbars=no')">5 Crear Proyecto</a></li>
				<li><a href="javascript:void(null);" onClick="window.open('Main.php?do=commonTutorialView&fileName=6_CargarHitos.wmv','tutorial','width=900,height=640,toolbar=no,status=yes,menubar=no,scrollbars=no')">6 Cargar Hitos</a></li>
				<li><a href="javascript:void(null);" onClick="window.open('Main.php?do=commonTutorialView&fileName=7_CargarObras.wmv','tutorial','width=900,height=640,toolbar=no,status=yes,menubar=no,scrollbars=no')">7 Cargar Obras</a></li>
				<li class="last"><a href="javascript:void(null);" onClick="window.open('Main.php?do=commonTutorialView&fileName=8_CargarIndicadoresDeImpacto.wmv','tutorial','width=900,height=640,toolbar=no,status=yes,menubar=no,scrollbars=no')">8 Cargar Indicadores de Impacto</a></li>
			</ul>
		</li>
|-/if-|
|-if !empty($loginAffiliateUser)-|
  	<ul>
		<li class="menuLink"><a href="Main.php?do=affiliatesUsersWelcome">Ir al Inicio</a></li>
	</ul>
	|-if $parameters.hasUnifiedUsernames.value neq "YES"-|
		<li><a href="Main.php?do=affiliatesUsersDoLogout" onClick='return window.confirm("¿Está eguro que quiere salir del sistema?")'>Salir</a></li>
	|-else-|
		<li><a href="Main.php?do=commonDoLogout" onClick='return window.confirm("¿Está seguro que quiere salir del sistema?")'>Salir</a></li>
	|-/if-|
|-/if-|
		</ul>
	</nav>
</div>