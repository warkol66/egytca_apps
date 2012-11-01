<script>
function checkscript() {
		alert('El sistema requiere que este módulo siempre esté activo.');
		return false;
	}
|-include file="ModulesJs.js"-|
</script>
<h2>Configuración del Sistema</h2>
<h1>Administración de Módulos del Sistema</h1>
<p>A continuación podrá administrar los módulos disponibles en el sistema. Para activar o desactivar módulos, debe tener en cuenta las dependencias de los mismos.</p> 
<div id="systemWorking" style="display:none;"></div><div id="messageResult"></div><div id="messageMod"></div>
<table width="100%" cellpadding="5" cellspacing="0" class="tableTdBorders"> 
	<tr class="thFillTitle"> 
		<th width="5%" scope="col">Activar</th> 
		<th width="15%" scope="col">Módulo</th> 
		<th width="65%" scope="col">Descripción</th> 
		<th width="5%" scope="col"></th> 
	</tr> 
	|-foreach from=$installedModules item=eachModule name=foreachModule-|
	<tr> 
		<td class="tdSize1" nowrap> <form id="form_|-$eachModule->getName()-|"> 
				<input type="hidden" name="module" value="|-$eachModule->getName()-|" /> 
				<input type="hidden" name="do" value="modulesDoActivateX" /> 
				|-if $eachModule->getAlwaysActive() eq 1-|
				<img src="images/clear.png" class="linkImageInfo" height="16" width="16" title="Haga click para obtener más información" alt="Haga click para obtener más información" onClick="return checkscript()"/> |-else-|
				<input type="checkbox" id="active_|-$eachModule->getName()-|" name="activeModule" value="1" |-$eachModule->getActive()|checked_bool-| onclick="modulesDoActivateX(this.form)" /> |-/if-|
		</form></td> 
		<td class="tdSize1"> <a href="Main.php?do=modulesEdit&moduleName=|-$eachModule->getName()-|">|-if $eachModule->getLabel() neq ''-||-$eachModule->getLabel()-||-else-||-$eachModule->getName()-||-/if-|</a> </td> 
		<td class="tdSize1"> |-$eachModule->getDescription()-| </td> 
		<td class="tdSize1"> 
		  <form action="Main.php" method="post" style="display:inline;">
        <input type="hidden" name="do" value="modulesEntitiesSchemaExport" />
        <input type="hidden" name="moduleName" value="|-$eachModule->getName()-|" />
        <input type="submit" name="submit_go_export_schema" value="Exportar schema" class="icon iconDownload"  title="Exportar schema" />
      </form>
		</td> 
	</tr> 
	|-/foreach-|
</table> 
