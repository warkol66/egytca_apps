<script type="text/javascript" src="Main.php?do=js&name=js&module=modules&code=|-$currentLanguageCode-|"></script>
<h2>Configuración del Sistema</h2>
<h1>Instalación de Módulos del Sistema: Módulo <strong>|-$moduleName-|</strong>.</h1>
<fieldset>
	<legend>Configuración de Permisos</legend>
	<p>Asigne los permisos correspondientes</p> 
	<form method="post">
		<p>
		<input type="submit" value="Generar archivo de permisos" />
		|-include file="ModulesInstallFormNavigationInclude.tpl"-|
	</p>

	<input type="hidden" name="moduleName" value="|-$moduleName-|" />
|-include file="SecurityEditPermissionsFormInclude.tpl"-|
 <p>&nbsp;</p>

	<p>
	<input type="hidden" name="do" value="modulesInstallDoSetupPermissions" />
	|-foreach from=$languages item=language-|
	<input type="hidden" name="languages[]" value="|-$language->getCode()-|" />
	|-/foreach-|	
	|-if isset($mode)-|
		<input type="hidden" name="mode" value="|-$mode-|" id="mode">
	|-/if-|
		<input type="submit" value="Generar archivo de permisos" />
		|-include file="ModulesInstallFormNavigationInclude.tpl"-|
	</p>
</form>
</fieldset>
