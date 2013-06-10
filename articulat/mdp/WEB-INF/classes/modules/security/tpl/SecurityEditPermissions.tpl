<h2>Configuración del Sistema</h2>
<h1>Administracion de Permisos</h1>
<p>A contuinuación podrá modificar los permisos de acceso a las diferentes funcionalidades del sistema. Para modificar los permisos, debe seleccionar un módulo y marcar los niveles de usuario que pueden acceder a cada acción del sistema.</p>
<fieldset>
	<legend>Seleccionar Módulo</legend>
	<p>Seleccione el módulo que desea administrar, el sistema lo redireccionará atomáticamente.</p>
<form method="get" style="display:inline;"><p>Seleccione un módulo
		<input type="hidden" name="do" value="securityEditPermissions" />
	<select name="moduleName" onchange="this.form.submit();">
		<option value="">|-if $moduleName ne ""-|Seleccionar otro|-else-|Seleccionar|-/if-| módulo</option>
	|-foreach from=$modules item=eachModule name=for_modules-|
		<option value="|-$eachModule-|" |-$eachModule|selected:$moduleName-|>|-$eachModule|multilang_get_translation:"common"-|</option>
	|-/foreach-|
	</select>
	</p></form>
</fieldset>
|-if $message eq "ok"-|
	<div class="successMessage">Modificación de permisos existosa</div>
|-elseif $message eq "failure"-|
	<div class="successMessage">Mo se pudo procesar su solicitud</div>
|-/if-|
 
|-if $moduleName neq ""-|
  <fieldset>
	<legend>Administracion de Permisos: Módulo |-$moduleName|multilang_get_translation:"common"-|</legend>
	<p>Asigne los permisos correspondientes y haga click en "Guardar Permisos" para guardar los cambios.</p> 
	<form method="post">
		<input type="hidden" name="do" value="securityDoEditPermissions" />
		<input type="hidden" name="moduleName" value="|-$moduleName-|" />
|-include file="SecurityEditPermissionsFormInclude.tpl"-|
<p>&nbsp;</p>
</form>
</fieldset>
|-/if-|
