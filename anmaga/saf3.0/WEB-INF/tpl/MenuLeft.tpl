|-if !empty($loginUser)-|
	<ul>
		<li class="menuLink"><a href="Main.php?do=usersWelcome">Ir al Inicio</a></li>
		<li class="menuLink"><a href="Main.php?do=catalogShow">Ver Catálogo</a></li>
		<li class="titleMenu" onclick="switch_vis('sectionCatalog')">Catálogo</li>
		<div id="sectionCatalog" style="display:|-if $module|upper eq "CATALOG"-|block|-else-|none|-/if-|">
			<li><a href="Main.php?do=catalogProductCategoriesList">Administrar Catálogo</a></li>
			<li><a href="Main.php?do=catalogProductsList">Administrar Productos</a></li>
			<li><a href="Main.php?do=catalogUnitsList">Administrar Unidades de Venta</a></li>
			<li><a href="Main.php?do=catalogMeasureUnitsList">Administrar Unidades de Medida</a></li>
			<li><a href="Main.php?do=catalogAffiliateProductList">Ver lista de precio por cliente</a></li>
			<li><a href="Main.php?do=catalogAffiliateProductsImport">Administrar listas de precio por cliente</a></li>
			<li><a href="Main.php?do=catalogAffiliateProductCodesList">Conversor de códigos</a></li>
		</div>
		<li class="titleMenu" onclick="switch_vis('sectionOrders')">Ordenes</li>
		<div id="sectionOrders" style="display:|-if $module|upper eq "CATALOG" || $module|upper eq "ORDERS"-|block|-else-|none|-/if-|">
			<li><a href="Main.php?do=ordersViewCart">Ver carrito de compras</a></li>
			<li><a href="Main.php?do=ordersList">Ver ordenes</a></li>
			<li><a href="Main.php?do=ordersTemplatesList">Ver plantillas de ordenes</a></li>
			<li><a href="Main.php?do=ordersList">Lista de Pedidos</a></li>
			<li><a href="Main.php?do=ordersImport">Importar Pedidos</a></li>
		</div>
	
		<li class="titleMenu" onclick="switch_vis('sectionAdmin')">Administración</li>
		<div id="sectionAdmin" style="display:|-if $module|upper eq 'USERS' || $module|upper eq 'AFFILIATES' || $module|upper eq 'MODULES' 
		|| $module|upper eq 'COMMON' || $module|upper eq 'SURVEYS' || $module|upper eq 'SECURITY'-|block|-else-|none|-/if-|">
			<li><a href="Main.php?do=affiliatesList">##affiliates,1,Afiliados##</a></li>
			<li><a href="Main.php?do=affiliatesBranchsList">##affiliates,5,Sucursales##</a></li>
			<li><a href="Main.php?do=affiliatesUsersList">##affiliates,2,Usuarios del afiliado##</a></li>
			<li><a href="Main.php?do=commonConfigSet">Cambiar Configuración</a></li>
			<li><a href="Main.php?do=commonConfigEdit">Editar Configuración</a></li>
			<li><a href="Main.php?do=commonConfigView">Ver Configuración</a></li>
			<li><a href="Main.php?do=backupList">Respaldos</a></li>
			<li><a href="Main.php?do=usersList">Usuarios</a></li>
			<li><a href="Main.php?do=usersLevelsList">Administrar Niveles de Usuario</a></li>
			<li><a href="Main.php?do=usersGroupsList">Administrar Grupos de Usuarios</a></li>
			<li><a href="Main.php?do=modulesList">Administrar módulos</a></li>
			<li><a href="Main.php?do=modulesInstallList">Instalar Modulos</a></li>
			<li><a href="Main.php?do=surveysList">Administrar Encuestas</a></li>
|-if $loginUser->isSupervisor()-|
			<li><a href="Main.php?do=securityEditPermissions">Administrar Permisos</a></li>
|-/if-|
		</div>
	</ul>
	<a href="Main.php?do=|-if ($configModule->get("global","unifiedUsernames"))-|commonDoLogout|-else-|usersDoLogout|-/if-|" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")' id="logout"></a>
|-else if !empty($loginAffiliateUser)-|
	<ul>
		<li class="menuLink"><a href="Main.php?do=usersWelcome">Ir al Inicio</a></li>
		<li class="menuLink"><a href="Main.php?do=catalogShow">Ver Catálogo</a></li>
		<li class="titleMenu" onclick="switch_vis('sectionOrders')">Ordenes</li>
		<div id="sectionOrders" style="display:|-if $module|upper eq "CATALOG" || $module|upper eq "ORDERS"-|block|-else-|none|-/if-|">
			<li><a href="Main.php?do=ordersViewCart">Ver carrito de compras</a></li>
			<li><a href="Main.php?do=ordersList">Ver ordenes</a></li>
			<li><a href="Main.php?do=ordersTemplatesList">Ver plantillas de ordenes</a></li>
			<li><a href="Main.php?do=ordersList">Lista de Pedidos</a></li>
		</div>
		<li class="titleMenu" onclick="switch_vis('sectionAdmin')">Administración</li>
		<div id="sectionAdmin" style="display:|-if $module|upper eq "AFFILIATES" || $module|upper eq "SURVEYS"-|block|-else-|none|-/if-|">
			<li><a href="Main.php?do=affiliatesUsersList">Administrar Usuarios</a></li>
			<li><a href="Main.php?do=affiliatesBranchsList">Administrar ##affiliates,5,Sucursales##</a></li>
			<li><a href="Main.php?do=surveysAffiliatesUsersFillBranchesSurvey">Encuestas de mercado</a></li>
		</div>
	</ul>
	<a href="Main.php?do=|-if ($configModule->get("global","unifiedUsernames"))-|commonDoLogout|-else-|affiliatesUsersDoLogout|-/if-|" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")' id="logout"></a>
|-/if-|