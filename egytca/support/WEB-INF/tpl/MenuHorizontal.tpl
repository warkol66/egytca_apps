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
			<li><a href="#" class="sub">Clientes</a>
			  <ul class="menu">
				<li><a href="Main.php?do=affiliatesList">Clientes</a></li>
				<li class="last"><a href="Main.php?do=affiliatesUsersList">Usuarios de Clientes</a></li>
			</ul>
		</li>
			<li><a href="#" class="sub">Desarrollos</a>
			  <ul class="menu">
				<li><a href="Main.php?do=requirementsDevelopmentsList">Desarrollos</a></li>
				<li class="last"><a href="Main.php?do=requirementsList">Requerimientos</a></li>
			</ul>
		</li>
		|-if $loginUser->isAdmin() || $loginUser->isSupervisor()-|		
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
				<li><a href="Main.php?do=commonConfigSet">Configurar Sistema</a></li>
				<li class="last"><a href="Main.php?do=commonConfigEdit">Editar Configuración</a></li>
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