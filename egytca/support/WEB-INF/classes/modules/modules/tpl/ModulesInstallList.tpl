<script type="text/javascript" src="Main.php?do=js&name=js&module=modules&code=|-$currentLanguageCode-|"></script>

<h2>Configuración</h2>
<h1>Instalación de Módulos del Sistema</h1>
<p>A continuación podrá instalar nuevos módulos o reinstalar aquellos que se encuentran en el sistema.</p>
|-if $message eq "success"-|
	<div class='successMessage'>El Módulo Ha sido instalado Correctamente</div>
|-elseif $message eq "success-sql"-|
	<div class='successMessage'>El Módulo Ha sido instalado Correctamente. Los Scripts de SQL se han cargado a la base de datos.</div>
|-elseif $message eq "step-success"-|
	<div class='successMessage'>El paso de instalacion ha sido ejecutado correctamente.</div>
|-elseif $message eq "phpmvc-xml-error"-|
	<div class='failureMessage'>El XML de phpmvc no es un xml válido.</div>
|-/if-|
|-if $modulesToInstall|@count gt 0-|
	<h4>Módulos disponibles para instalar</h4>
	<p>

<!-- new form is inserted here (for firefox compatibility) -->
<div id="dummy" style="display:none;"></div>

<script language="JavaScript" type="text/JavaScript">
function checkAll(elementName) {
	allbox = document.getElementById("allBoxes");
  var elements = document.getElementsByName(elementName);
  for (var i = 0; i < elements.length; i++) {
  	elements[i].checked = allbox.checked;
  }
}

function uncheckedInstall() {
	
	var modules = document.getElementsByName('modules[]');
	
	var form = document.createElement('form');
	form.action = 'Main.php?do=modulesInstallUnchecked';
	form.method = 'post';
	for (var i = 0; i < modules.length; i++) {
		form.appendChild(modules[i].clone());
	}
	
	$('dummy').appendChild(form); // firefox compatibility
	
	form.submit();
}
</script>
<table width="100%" cellpadding="5" cellspacing="0" class="tableTdBorders"> 
	<tr> 
		<th width="2%" scope="col">&nbsp;</th> 
		<th width="18%" scope="col">Nombre del Módulo</th> 
		<th width="80%" scope="col">Pasos Específicos del proceso de instalación</th> 
	</tr> 
	|-foreach from=$modulesToInstall item=eachModule name=modulef-|
	<tr> 
		<th>
			<input type="checkbox" name="modules[]" value="|-$eachModule-|">
		</th>
		<td>|-$eachModule|multilang_get_translation:"common"-|</td> 
		<td nowrap>
			<form method="get">
				<input type="hidden" name="do" value="modulesInstallSetupSelectLanguages" />
				<input type="hidden" name="moduleName" value="|-$eachModule-|" />
				<input type="hidden" name="nextDo" value="modulesInstallSetupModuleInformation" />
				<input type="submit" value="Información de Módulo" />
			</form>		
			<form method="get">
				<input type="hidden" name="do" value="modulesInstallSetupSelectLanguages" />
				<input type="hidden" name="moduleName" value="|-$eachModule-|" />
				<input type="hidden" name="nextDo" value="modulesInstallSetupActionsLabel" />
				<input type="submit" value="Acciones" />
			</form>
			<form method="get">
				<input type="hidden" name="do" value="modulesInstallSetupSelectLanguages" />
				<input type="hidden" name="moduleName" value="|-$eachModule-|" />
				<input type="hidden" name="nextDo" value="modulesInstallSetupPermissions" />
				<input type="submit" value="Permisos" />
			</form>
			<form method="get">
				<input type="hidden" name="do" value="modulesInstallSetupSelectLanguages" />
				<input type="hidden" name="moduleName" value="|-$eachModule-|" />
				<input type="hidden" name="nextDo" value="modulesInstallSetupMessages" />
				<input type="submit" value="Mensajes de Log" />
			</form>
			<form method="get">
				<input type="hidden" name="do" value="modulesInstallSetupSelectLanguages" />
				<input type="hidden" name="moduleName" value="|-$eachModule-|" />
				<input type="hidden" name="nextDo" value="modulesInstallFileCheck" />
				<input type="submit" value="Ejecutar Instalación" />
			</form>
		</td> 
	</tr> 
	|-/foreach-|
	|-if $modulesToInstall|count gt 0-|
	<tr>
	  <th width="2%" scope="col">
		<input id="allBoxes" onclick="javascript:checkAll('modules[]')" type="checkbox" title="Seleccionar todo"></th>
		<td colspan="2"><input name="installChecked" type="button" value="Instalar módulos seleccionados" onclick="uncheckedInstall();"></td>
		</tr>
	|-/if-|
</table>
|-/if-|
|-if $modulesInstalled|@count gt 0-|
<h4>Módulos Instalados</h4> 
<table width="100%" cellpadding="5" cellspacing="0" class="tableTdBorders"> 
	<tr> 
		<th width="20%" scope="col">Nombre del Módulo</th> 
		<th width="80%" scope="col">Pasos Específicos del proceso de instalación</th>		 
	</tr> 
	|-foreach from=$modulesInstalled item=eachModule name=modulef-|
	<tr> 
		<td>|-$eachModule->getName()|multilang_get_translation:"common"-|</td> 
		<td nowrap>
			<form method="get">
				<input type="hidden" name="do" value="modulesInstallSetupSelectLanguages" />
				<input type="hidden" name="moduleName" value="|-$eachModule->getName()-|" />
				<input type="hidden" name="nextDo" value="modulesInstallSetupModuleInformation" />
				<input type="hidden" name="mode" value="reinstall">
				<input type="submit" value="Información de Módulo" />
			</form>		
			<form method="get">
				<input type="hidden" name="do" value="modulesInstallSetupSelectLanguages" />
				<input type="hidden" name="moduleName" value="|-$eachModule->getName()-|" />
				<input type="hidden" name="mode" value="reinstall">
				<input type="hidden" name="nextDo" value="modulesInstallSetupActionsLabel" />
				<input type="submit" value="Acciones" />
			</form>
			<form method="get">
				<input type="hidden" name="do" value="modulesInstallSetupSelectLanguages" />
				<input type="hidden" name="moduleName" value="|-$eachModule->getName()-|" />
				<input type="hidden" name="mode" value="reinstall">
				<input type="hidden" name="nextDo" value="modulesInstallSetupPermissions" />
				<input type="submit" value="Permisos" />
			</form>
			<form method="get">
				<input type="hidden" name="do" value="modulesInstallSetupSelectLanguages" />
				<input type="hidden" name="moduleName" value="|-$eachModule->getName()-|" />
				<input type="hidden" name="mode" value="reinstall">
				<input type="hidden" name="nextDo" value="modulesInstallSetupMessages" />
				<input type="submit" value="Mensajes de Log" />
			</form>
			<form method="get">
				<input type="hidden" name="do" value="modulesInstallSetupSelectLanguages" />
				<input type="hidden" name="moduleName" value="|-$eachModule->getName()-|" />
				<input type="hidden" name="mode" value="reinstall">
				<input type="hidden" name="nextDo" value="modulesInstallFileCheck" />
				<input type="submit" value="Ejecutar Instalación" />
			</form>
		</td> 
	</tr> 
	|-/foreach-|
</table>
|-/if-|
