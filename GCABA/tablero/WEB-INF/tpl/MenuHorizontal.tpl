<div id="mainMenuH">
	<nav>
		<ul class="menu">
|-if !empty($loginUser)-|
	|-if $SESSION.firstLogin-|
			<li><a href="Main.php?do=usersPasswordChange&firstLogin=firstLogin">Actualice su clave</a></li>
			|-if !empty($loginUser)-|
				<li><a href="Main.php?do=usersDoLogout" onClick='return window.confirm("Si ya actualizó su clave, puede proceder a salir del sistema. ¿Está seguro que quiere salir del sistema?")'>Salir</a></li>
			|-else-|
				<li><a href="Main.php?do=affiliatesUsersDoLogout" onClick='return window.confirm("Si ya actualizó su clave, puede proceder a salir del sistema. ¿Está seguro que quiere salir del sistema?")'>Salir</a></li>
			|-/if-|				
	|-else-|
			<li><a href="Main.php?do=usersWelcome" class="sub">Ir al Inicio</a>
			<ul class="menu">
				<li class="last">|-if !$SESSION.panelMode-|<a href="Main.php?do=panelSetPanel">Cambiar a Modo Seguimiento</a>|-else-|<a href="Main.php?do=planningSetPlanning">Cambiar a Modo Planeamiento</a>|-/if-|</li>
			</ul>
		</li>
			<li><a href="#" class="sub">Objetivos</a>
			  <ul class="menu">
				<li><a href="Main.php?do=planningImpactObjectivesList">Objetivos de Impacto</a></li>
				<li><a href="Main.php?do=planningMinistryObjectivesList">Objetivos Ministeriales</a></li>
				<li class="last"><a href="Main.php?do=planningOperativeObjectivesList">Objetivos Operativos</a></li>
			</ul>
		</li>
			<li><a href="javascript:void(null)" class="sub">Proyectos</a>
			  <ul class="menu">
				<li><a href="Main.php?do=planningProjectsList">Proyectos</a></li>
				<li><a href="Main.php?do=planningConstructionsList">Obras</a></li>
				<li class="last"><a href="Main.php?do=planningActivitiesList">Actividades e Hitos</a></li>
			</ul>
		</li>
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
				<li><a href="Main.php?do=categoriesList">Categorías</a></li>
				<li><a href="Main.php?do=commonActionLogsList">Histórico de Operaciones</a></li>
				<li class="last"><a href="Main.php?do=backupList">Respaldos</a></li>
			</ul></li>
			|-if $loginUser->isSupervisor()-|		
			<li><a href="javascript:void(null)" class="sub">Configuración</a>
				<ul>
					<li class="last"><a href="Main.php?do=securityEditPermissions">Administrar permisos</a></li>
					<li><a href="Main.php?do=usersPasswordChange">Actualice su contraseña</a></li>
					<li><a href="Main.php?do=commonConfigSet">Configurar Sistema</a></li>
					<li><a href="Main.php?do=commonMeasureUnitsList">Unidades de Medida</a></li>
					<li class="last"><a href="Main.php?do=commonConfigEdit">Editar Configuración</a></li>
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
				<li><a href="tutoriales/1_Bienvenida.avi" target="_blank">1 Bienvenida</a></li>
				<li><a href="tutoriales/2_CrearObjetivoDeImpacto.avi" target="_blank">2 Crear Objetivo de Impacto</a></li>
				<li><a href="tutoriales/3_CrearObjetivoMinisterial.avi" target="_blank">3 Crear Objetivo Ministerial</a></li>
				<li><a href="tutoriales/4_CrearObjetivoOperativo.avi" target="_blank">4 Crear Objetivo Operativo</a></li>
				<li><a href="tutoriales/5_CrearProyecto.avi" target="_blank">5 Crear Proyecto</a></li>
				<li><a href="tutoriales/6_CargarHitos.avi" target="_blank">6 Cargar Hitos</a></li>
				<li><a href="tutoriales/7_CargarObras.avi" target="_blank">7 Cargar Obras</a></li>
				<li class="last"><a href="tutoriales/8_CargarIndicadoresDeImpacto.avi" target="_blank">8 Cargar Indicadores de Impacto</a></li>
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