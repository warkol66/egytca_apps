<div id="mainMenuH">
	<nav>
		<ul class="nav menu">
|-if !empty($loginUser)-|
	|-if $SESSION.firstLogin-|
			<li><a href="Main.php?do=usersPasswordChange&firstLogin=firstLogin">Actualice su clave</a></li>
			|-if !empty($loginUser)-|
				<li><a href="Main.php?do=usersDoLogout" onClick='return window.confirm("Si ya actualizó su clave, puede proceder a salir del sistema. ¿Esta seguro que quiere salir del sistema?")'>Salir</a></li>
			|-else-|
				<li><a href="Main.php?do=affiliatesUsersDoLogout" onClick='return window.confirm("Si ya actualizó su clave, puede proceder a salir del sistema. ¿Esta seguro que quiere salir del sistema?")'>Salir</a></li>
			|-/if-|				
	|-else-|
			<li><a href="Main.php?do=newsArticlesShow">Ir al Inicio</a></li>
			<li><a href="#" class="sub"><span class="titleMenu">Red de Líderes</span></a>
			<ul class="menu">
				<li><a href="Main.php?do=blogShow">Experiencias Exitosas</a></li>
				<li><a href="Main.php?do=boardView">Desafíos</a></li>
				<li><a href="Main.php?do=documentsList">Documentos</a></li>
				<li><a href="Main.php?do=calendarMonth">Eventos</a></li>
				<li><a href="Main.php?do=newsArticlesShow">Novedades</a></li>
				<li><a href="Main.php?do=commonChat">Chat</a></li>
				<li class="last"><a href="Main.php?do=commonInternalMailsList">Mensajería Interna</a></li>
			</ul>
		</li>
		<li><a href="#" class="sub">Su cuenta</a>
			<ul>
				<li><a href="Main.php?do=usersEditInfo">Modifique su cuenta</a></li>
				<li class="last"><a href="Main.php?do=usersPasswordChange">Modifique su contraseña</a></li>
			</ul>
		</li>
		|-if !empty($loginUser) && ($loginUser->isSupervisor() || $loginUser->isAdmin() || $loginUser->belongsToGroups(3))-|
			<li><a href="#" class="sub"><span class="titleMenu">Aplicaciones</span></a>
			<ul class="menu">
				<li><a href="Main.php?do=boardList">Desafíos</a></li>
				<li><a href="Main.php?do=contentList">Contenidos</a></li>
				<li><a href="Main.php?do=blogList">Experiencias Exitosas</a></li>
				<li><a href="Main.php?do=documentsList">Documentos</a></li>
				<li><a href="Main.php?do=calendarList">Eventos</a></li>
				<li class="last"><a href="Main.php?do=newsArticlesList">Novedades</a></li>
			</ul>
		</li>
		|-/if-|
		<li><a href="Main.php?do=commonDoLogout" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")'>Salir</a></li>
		</ul>
	|-/if-|
|-/if-|
	</nav>
</div>
