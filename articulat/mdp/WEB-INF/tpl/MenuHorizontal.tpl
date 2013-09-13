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
			<li class="narrow"><a href="Main.php?do=usersWelcome">Inicio</a>
					|-if $SESSION.supervisorUser-|<ul class="menu"><li><a href="Main.php?do=usersDoExit">Volver a usuario '|-$SESSION.supervisorUser-|'</a></li></ul>|-/if-|	
			</li>
			<li class="wide"><a href="#" class="sub">Repercusiones de Prensa</a>
			  <ul class="menu">
				<li><a href="Main.php?do=headlinesList">Administrar Titulares</a></li>
				<li><a href="Main.php?do=headlinesParsedList">Obtener Titulares</a></li>
				<li><a href="Main.php?do=twitterCampaignsList">Administrar Tweets</a></li>
				<li><a href="Main.php?do=issuesList">Administrar ##issues,1,Asuntos##</a></li>
				<li><a href="Main.php?do=campaignsList">Administrar Campañas</a></li>
				<li class="last"><a href="Main.php?do=headlinesReports">Reportes</a></li>
			</ul>
		</li>
		|-if $loginUser->isAdmin() || $loginUser->isSupervisor()-|		
			<li><a href="javascript:void(null)" class="sub">Configuración</a>
			  <ul class="menu">
				<li><a href="Main.php?do=actorsList">Actores</a></li>
<!--					<li><a href="Main.php?do=categoriesList">Categorías</a></li>-->

				<li><a href="Main.php?do=mediasList">Medios</a></li>
				<li><a href="Main.php?do=mediasTypeList">Tipo de medios</a></li>
				<li><a href="Main.php?do=headlinesTagsList">Etiquetas</a></li>
				<li class="last"><a href="Main.php?do=mediasAudienceList">Audiencias</a></li>
				<li class="last"><a href="Main.php?do=templatesList">Plantillas y fuentes</a></li>
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
		<li><a href="javascript:void(null)" class="sub">Parámetros</a>
			<ul>
				<li><a href="Main.php?do=commonConfigSet">Configurar Sistema</a></li>
				<li class="last"><a href="Main.php?do=commonConfigEdit">Editar Configuración</a></li>
			</ul></li>
		|-/if-|		
	|-/if-|
		<li class="narrow"><a href="Main.php?do=usersDoLogout">Salir</a></li>
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
