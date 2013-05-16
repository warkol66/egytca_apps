<div id="mainMenuH">
	<nav>
		<ul class="nav menu">
			<li><a href="Main.php?do=contentShow">Ir al Inicio</a></li>
			<li><a href="#" class="sub"><span class="titleMenu">Red de Líderes</span></a>
			<ul class="menu">
				<li><a href="Main.php?do=blogShow">Experiencias Exitosas</a></li>
				<li><a href="Main.php?do=boardView&url=">Challenging board</a></li>
				<li><a href="Main.php?do=calendarMonth">Eventos</a></li>
				<li class="last"><a href="Main.php?do=newsArticlesShow">Novedades</a></li>
			</ul>
		</li>
		<li><a href="#" class="sub">Documentación</a>
			<ul>
				<li class="last"><a href="Main.php?do=documentsShow">Documentos</a></li>
			</ul>
		</li>
		<li><a href="#" class="sub">Su cuenta</a>
			<ul>
				<li><a href="Main.php?do=usersEditInfo">Modifique su cuenta</a></li>
				<li class="last"><a href="Main.php?do=usersPasswordChange">Modifique su contraseña</a></li>
			</ul>
		</li>
		|-if !empty($loginUser) && ($loginUser->isSupervisor() || $loginUser->isAdmin() || $loginUser->belongsToGroups(3))-|
		<li><a href="Main.php?do=usersLogin">Administración</a></li>
		|-/if-|
		<li><a href="Main.php?do=commonDoLogout" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")'>Salir</a></li>
	</nav>
</div>
