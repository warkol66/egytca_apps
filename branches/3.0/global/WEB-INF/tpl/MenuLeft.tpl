|-if $loginUser neq ""-|
	<ul>
		<li><a href="Main.php?do=usersWelcome">Ir al Inicio</a></li>

		<li class="titleMenu">Aplicaciones</li>
			<li><a href="Main.php?do=lausiThemesList">Motivos</a></li>
			<li><a href="Main.php?do=lausiAddressesList">Direcciones</a></li>
			<li><a href="Main.php?do=lausiClientsList">Clientes</a></li>
			<li><a href="Main.php?do=lausiClientAddressesList">Direcciones Importantes de Clientes</a></li>
			<li><a href="Main.php?do=lausiBillboardsList">Carteleras</a></li>
			<li><a href="Main.php?do=lausiCircuitsList">Circuitos</a></li>
			<li><a href="Main.php?do=lausiRegionsList">Barrios</a></li>
			<li><a href="Main.php?do=lausiWorkforcesList">Contratistas</a></li>
			<li><a href="Main.php?do=lausiWorkforcesAssignAdmin">Avisos Sextuples por Contratista</a></li>
			<!--<li><a href="Main.php?do=lausiAddressesOrder">Ordenamiento de Direcciones</a></li>-->
			<li><a href="Main.php?do=backupList">Respaldos</a></li>

		<li class="titleMenu">Distribución de Motivos</li>
			<li><a href="Main.php?do=lausiDistributeByRegion">Por Barrio</a></li>
			<li><a href="Main.php?do=lausiDistributeByCircuit">Por Circuito</a></li>
			<li><a href="Main.php?do=lausiDistributeByCircuitPercentage">Porcentual Por Circuito</a></li>
			<li><a href="Main.php?do=lausiDistributeByRating">Por Valoración</a></li>
			<li><a href="Main.php?do=lausiDistributeByLocation">Por Ubicación Geográfica</a></li>
			<li><a href="Main.php?do=lausiThemesRotate">Rotación de Motivos</a></li>		
			<li><a href="Main.php?do=lausiAdvertisementsList">Ver Avisos</a></li>
		
		<li class="titleMenu">Asignar Avisos Séxtuples</li>
			<li><a href="Main.php?do=lausiWorkforcesAssign">Asignar Contratistas</a></li>

		<li class="titleMenu">Pautas</li>
		<li><a href="Main.php?do=lausiCampaignsShow">Administrar Motivos</a></li>

		<li class="titleMenu">Reportes</li>
			<li><a href="Main.php?do=lausiReportsRouteSheet">Hoja de Ruta Séxtuples</a></li>
			<li><a href="Main.php?do=lausiReportsSheetsLocation">Hoja de Ruta Dobles</a></li>
			<li><a href="Main.php?do=lausiReportsThemes">Motivos</a></li>
			<li><a href="Main.php?do=lausiAdvertisementsList&amp;clientReport=1">Para Clientes</a></li>
			<li><a href="Main.php?do=lausiReportsAddresses">Direcciones</a></li>
			<li><a href="Main.php?do=lausiReportsBillboardsOwned">Carteleras por Circuito</a></li>			
			<li><a href="Main.php?do=lausiReportsThemesCircuit">Motivos por Circuito</a></li>

		<li class="titleMenu"><a href="javascript:switch_vis('adminMenu');" class="titleLink">Administración</a></li>
			<div id="adminMenu" style="display:|-if $module|lower eq 'users' || $module|lower eq 'categories' || $module|lower eq 'config' || $module|lower eq 'calendar'-|block|-else-|none|-/if-|;">			<li><a href="Main.php?do=usersList">Usuarios</a></li>
			<li><a href="Main.php?do=usersGroupsList">Grupos de Usuarios</a></li>
			<li><a href="Main.php?do=usersLevelsList">Niveles Usuarios</a></li>
			<li><a href="Main.php?do=configView">Ver Configuración</a></li>
			<li><a href="Main.php?do=configSet">Configurar Sistema</a></li>
			<li><a href="Main.php?do=configEdit">Editar Configuración</a></li>
		</div>
	</ul>
	<a href="Main.php?do=usersDoLogout" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")' id="logout"></a>
|-/if-|
