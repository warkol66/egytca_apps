|-if !empty($loginUser)-|
	|-if $SESSION.firstLogin-|
	<ul>
			<li><a href="Main.php?do=usersPasswordChange&firstLogin=firstLogin">Actualice su clave</a></li>
	</ul>
	<a href="Main.php?do=|-if ($configModule->get("global","unifiedUsernames"))-|commonDoLogout|-else-|usersDoLogout|-/if-|" onClick='return window.confirm("Si ya actualizó su clave, puede proceder a salir del sistema. ¿Esta seguro que quiere salir del sistema?")' id="logout">Salir del Sistema</a>
	|-else-|
	<ul>
		<li><a href="Main.php?do=usersWelcome">Ir al Inicio</a></li>

		<li class="titleMenu" onclick="$('sectionApplications').toggle()">Aplicaciones</li>
		<div id="sectionApplications" style="display:|-if $module|upper eq 'VIALIDAD' || $module|upper eq 'AFFILIATES'-|block|-else-|none|-/if-|">

			|-if "affiliatesList"|security_has_access-|<li><a href="Main.php?do=affiliatesList">Proveedores</a></li>|-/if-|
			<!--|-if "affiliatesContractorsList"|security_has_access-|<li><a href="Main.php?do=affiliatesContractorsList">Contratistas</a></li>|-/if-|
			|-if "affiliatesVerifiersList"|security_has_access-|<li><a href="Main.php?do=affiliatesVerifiersList">Fiscalizadoras</a></li>|-/if-|-->
			|-if "vialidadContractsList"|security_has_access-|<li><a href="Main.php?do=vialidadContractsList">Contratos</a></li>|-/if-|
			<!--|-if "vialidadConstructionsList"|security_has_access-|<li><a href="Main.php?do=vialidadConstructionsList">Obras</a></li>|-/if-|
			|-if "vialidadSuppliersList"|security_has_access-|<li><a href="Main.php?do=vialidadSuppliersList">Proveedores de Insumos</a></li>|-/if-|-->

			|-if "vialidadSupplyList"|security_has_access-|<li><a href="Main.php?do=vialidadSupplyList">Insumos de Obra</a></li>|-/if-|
			|-if "vialidadSupplyOtherList"|security_has_access-|<li><a href="Main.php?do=vialidadSupplyOtherList">Otros Insumos</a></li>|-/if-|

			|-if "vialidadBulletinList"|security_has_access-|<li><a href="Main.php?do=vialidadBulletinList">Base de Datos de Insumos</a></li>|-/if-|
			|-if "vialidadConstructionItemList"|security_has_access-|<li><a href="Main.php?do=vialidadConstructionItemList">Paramétricas de Obra</a></li>|-/if-|
			|-if "vialidadMeasurementRecordsList"|security_has_access-|<li><a href="Main.php?do=vialidadMeasurementRecordsList">Actas de Medición</a></li>|-/if-|
			|-if "vialidadCertificatesList"|security_has_access-|<li><a href="Main.php?do=vialidadCertificatesList">Certificados de Obra</a></li>|-/if-|
			|-if "vialidadInvoicesList"|security_has_access-|<li><a href="Main.php?do=vialidadInvoicesList">Facturas de Contratistas</a></li>|-/if-|
			|-if "vialidadConstructionsReport"|security_has_access-|<li><a href="Main.php?do=vialidadConstructionsReport" target="_blank" title="Abre en ventana nueva">Reporte de Obras</a></li>|-/if-|
			|-if "vialidadSourcesList"|security_has_access-|<li><a href="Main.php?do=vialidadSourcesList">Fuentes de Finaciamiento</a></li>|-/if-|
			|-if "vialidadDepartmentsList"|security_has_access-|<li><a href="Main.php?do=vialidadDepartmentsList">Departamentos</a></li>|-/if-|
			|-if "vialidadConstructionTypesList"|security_has_access-|<li><a href="Main.php?do=vialidadConstructionTypesList">Tipos de Obra</a></li>|-/if-|
			|-if "vialidadCurrenciesList"|security_has_access-|<li><a href="Main.php?do=vialidadCurrenciesList">Monedas</a></li>|-/if-|
			|-if "vialidadMeasureUnitsList"|security_has_access-|<li><a href="Main.php?do=vialidadMeasureUnitsList">Unidades de Medida</a></li>|-/if-|

		</div>

		<li class="titleMenu" onclick="$('sectionAdmin').toggle()">Administración</li>
		<div id="sectionAdmin" style="display:|-if $module|upper eq 'USERS' || $module|upper eq 'AFFILIATES' || $module|upper eq 'MODULES' 
		|| $module|upper eq 'COMMON' || $module|upper eq 'SURVEYS' || $module|upper eq 'SECURITY' || $module|upper eq 'BACKUP'-|block|-else-|none|-/if-|">
			|-if "affiliatesUsersList"|security_has_access-|<li><a href="Main.php?do=affiliatesUsersList">Usuarios de Empresas</a></li>|-/if-|
			|-if "commonConfigSet"|security_has_access-|<li><a href="Main.php?do=commonConfigSet">Cambiar Configuración</a></li>|-/if-|
			|-if "commonConfigSet"|security_has_access-|<li><a href="Main.php?do=commonConfigEdit">Editar Configuración</a></li>|-/if-|
			|-if "commonConfigView"|security_has_access-|<li><a href="Main.php?do=commonConfigView">Ver Configuración</a></li>|-/if-|
			|-if "backupList"|security_has_access-|<li><a href="Main.php?do=backupList">Respaldos</a></li>|-/if-|
			|-if "usersList"|security_has_access-|<li><a href="Main.php?do=usersList">Usuarios</a></li>|-/if-|
			|-if "usersLevelsList"|security_has_access-|<li><a href="Main.php?do=usersLevelsList">Administrar Niveles de Usuario</a></li>|-/if-|
			|-if "usersGroupsList"|security_has_access-|<li><a href="Main.php?do=usersGroupsList">Administrar Grupos de Usuarios</a></li>|-/if-|
			|-if "modulesList"|security_has_access-|<li><a href="Main.php?do=modulesList">Administrar módulos</a></li>|-/if-|
			|-if "modulesInstallList"|security_has_access-|<li><a href="Main.php?do=modulesInstallList">Instalar Modulos</a></li>|-/if-|
		|-if $loginUser->isSupervisor()-|
			<li><a href="Main.php?do=securityEditPermissions">Administrar Permisos</a></li>
		|-/if-|
		</div>
	</ul>

	<a href="Main.php?do=|-if ($configModule->get("global","unifiedUsernames"))-|commonDoLogout|-else-|usersDoLogout|-/if-|" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")' id="logout">Salir del Sistema</a>
	|-/if-|
|-elseif !empty($loginAffiliateUser)-|
	|-if $SESSION.firstLogin-|
		<ul>
			<li><a href="Main.php?do=affiliatesUsersPasswordChange&firstLogin=firstLogin">Actualice su clave</a></li>
		</ul>
		<a href="Main.php?do=|-if ($configModule->get("global","unifiedUsernames"))-|commonDoLogout|-else-|affiliatesUsersDoLogout|-/if-|" onClick='return window.confirm("Si ya actualizó su clave, puede proceder a salir del sistema. ¿Esta seguro que quiere salir del sistema?")' id="logout">Salir del Sistema</a>
	|-else-|
	<ul>
		<li class="menuLink"><a href="Main.php?do=affiliatesUsersWelcome">Ir al Inicio</a></li>

		<li class="titleMenu" onclick="$('sectionApplications').toggle()">Aplicaciones</li>
		<div id="sectionApplications" style="display:|-if $module|upper eq 'VIALIDAD'-|block|-else-|none|-/if-|">
		|-if !empty($SESSION.affiliate) && is_object($SESSION.affiliate)-|
			|-assign var=classKey value=$SESSION.affiliate->getClasskey()-|
			|-if $classKey eq '2'-||-* 2=contractor, 3=verifier *-|
				|-if "vialidadContractsList"|security_has_access-|<li><a href="Main.php?do=vialidadContractsList">Contratos</a></li>|-/if-|
			|-/if-|
			|-if "vialidadConstructionsList"|security_has_access-|<li><a href="Main.php?do=vialidadConstructionsList">Obras</a></li>|-/if-|
			|-if "vialidadMeasurementRecordsList"|security_has_access-|<li><a href="Main.php?do=vialidadMeasurementRecordsList">Actas de Medición</a></li>|-/if-|
		|-/if-|

			<li><a href="Main.php?do=vialidadBulletinList">Boletines</a></li>
		</div>

		<li class="titleMenu" onclick="switch_vis('sectionAdmin')">Administración</li>
		<div id="sectionAdmin" style="display:|-if $module|upper eq "AFFILIATES"-|block|-else-|none|-/if-|">
			|-if "usersList"|security_has_access-|<li><a href="Main.php?do=affiliatesUsersList">Administrar Usuarios</a></li>|-/if-|

		</div>
	</ul>
	<a href="Main.php?do=|-if ($configModule->get("global","unifiedUsernames"))-|commonDoLogout|-else-|affiliatesUsersDoLogout|-/if-|" onClick='return window.confirm("¿Esta seguro que quiere salir del sistema?")' id="logout">Salir del Sistema</a>
	|-/if-|
|-/if-|
