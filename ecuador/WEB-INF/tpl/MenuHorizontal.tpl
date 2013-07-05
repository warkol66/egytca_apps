<div id="mainMenuH">
	<nav>
		<ul class="nav menu">
|-if !empty($loginUser)-|
	|-if $SESSION.firstLogin-|
			<li><a href="Main.php?do=usersPasswordChange&firstLogin=firstLogin">Actualice su clave</a></li>
			|-if !empty($loginUser)-|
				<li class="narrow"><a href="Main.php?do=usersDoLogout" onClick='return window.confirm("Si ya actualizó su clave, puede proceder a salir del sistema. ¿Esta seguro que quiere salir del sistema?")'>Salir</a></li>
			|-else-|
				<li class="narrow"><a href="Main.php?do=affiliatesUsersDoLogout" onClick='return window.confirm("Si ya actualizó su clave, puede proceder a salir del sistema. ¿Esta seguro que quiere salir del sistema?")'>Salir</a></li>
			|-/if-|				
	|-else-|
			<li class="narrow"><a href="Main.php?do=newsArticlesShow">Ir al Inicio</a></li>
			<li><a href="#" class="sub"><span class="titleMenu">Red de Líderes</span></a>
				<ul class="menu">
					<li><a href="Main.php?do=blogShow">Experiencias de Gestión</a></li>
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
			|-if $loginUser->isAdmin()-|
			<li><a href="#" class="sub"><span class="titleMenu">Aplicaciones</span></a>
			<ul class="menu">
				<li><a href="Main.php?do=boardList">Desafíos</a></li>
				<li><a href="Main.php?do=contentList">Contenidos</a></li>
				<li><a href="Main.php?do=blogList">Experiencias de Gestión</a></li>
				<li><a href="Main.php?do=calendarList">Eventos</a></li>
				<li class="last"><a href="Main.php?do=newsArticlesList">Novedades</a></li>
			</ul>
		</li>
		|-/if-|
		<li><a href="#" class="sub">Administración</a>
			<ul>
				<li><a href="Main.php?do=usersList">Usuarios</a></li>
				<li><a href="Main.php?do=usersGroupsList">Grupos de Usuarios</a></li>
				<li><a href="Main.php?do=usersLevelsList">Niveles Usuarios</a></li>
				<li><a href="Main.php?do=blogTagsList">Etiquetas de experiencias exitosas</a></li>
				<li><a href="Main.php?do=regionsList">Parroquias</a></li>
				<li><a href="Main.php?do=categoriesList&filters[searchModule]=documents">Categorías de documentos</a></li>
				<li><a href="Main.php?do=bannersList">Banners</a></li>
				<li class="last"><a href="Main.php?do=backupList">Respaldos</a></li>
			</ul></li>
		|-if $loginUser->isSupervisor()-|		
		<li><a href="#" class="sub">Configuración</a>
			<ul>
				<!-- <li class="menuLink"><a href="Main.php?do=commonConfigView">Ver Configuración</a></li> -->
				<li><a href="Main.php?do=commonConfigSet">Configurar Sistema</a></li>
				<li class="last"><a href="Main.php?do=commonConfigEdit">Editar Configuración</a></li>
<!-- 				<li><a href="Main.php?do=multilangLanguagesList">Idiomas</a></li>
				<li><a href="Main.php?do=multilangTextsList">Textos</a></li>		
				<li class="last"><a href="Main.php?do=multilangTextsDump&amp;moduleName=|-*$moduleName*-|">Textos SQL</a></li>			 -->
			</ul></li>
|-/if-|
		<li class="narrow"><a href="Main.php?do=|-if ($configModule->get("global","unifiedUsernames"))-|commonDoLogout|-else-|affiliatesUsersDoLogout|-/if-|" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")'>Salir</a></li>
|-/if-|
|-/if-|
|-if !empty($loginAffiliateUser)-|
  	<ul>
		<li class="narrow"><a href="Main.php?do=affiliatesUsersWelcome">Ir al Inicio</a></li>
	</ul>
	|-if $parameters.hasUnifiedUsernames.value neq "YES"-|
		<li class="narrow"><a href="Main.php?do=affiliatesUsersDoLogout" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")'>Salir</a></li>
	|-else-|
		<li class="narrow"><a href="Main.php?do=commonDoLogout" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")'>Salir</a></li>
	|-/if-|
|-/if-|
		</ul>
	</nav>
</div>
