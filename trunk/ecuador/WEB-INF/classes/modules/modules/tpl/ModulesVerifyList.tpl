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
		<th width="15%" scope="col">Módulo</th> 
		<th width="65%" scope="col">Descripción</th> 
		<th width="5%" scope="col"></th> 
	</tr> 
	|-foreach from=$moduleColl item=eachModule name=foreachModule-|
	<tr> 
		<td class="tdSize1"> <a href="Main.php?do=modulesEdit&moduleName=|-$eachModule->getName()-|">|-if $eachModule->getLabel() neq ''-||-$eachModule->getLabel()-||-else-||-$eachModule->getName()-||-/if-|</a> </td> 
		<td class="tdSize1"> |-$eachModule->getDescription()-| </td> 
		<td class="tdSize1"> 
		  <form action="Main.php" method="post" style="display:inline;" id="|-$eachModule->getName()-|">
			<input type="hidden" name="do" value="modulesDoVerifyX" />
			<input type="hidden" name="moduleName" value="|-$eachModule->getName()-|" />
			<input type="button" onClick="javascript:verifyModule('|-$eachModule->getName()-|')" name="submit_go_verify_module" value="Verificar módulo" class="icon iconDownload"  title="Verificar módulo" />
		  </form>
		</td> 
	</tr> 
	|-/foreach-|
</table> 
