<table>
	<h3>Seguridad de los módulos</h3>
	<tr>
		<td>Aqui puede controlar el acceso a los módulos para los distintos tipos de usuarios.
		</td>
	<tr>
</table>
<form name="security2" action="Main.php?do=securityModuleDoSave" method="POST">
	<table width="100%" border="1" cellpadding="0" cellspacing="1" class="tablaborde"> 
		<tr> 
			<th scope="col">Modulos</th> 
			<th scope="col">Descripcion</th>
			|-foreach from=$userTypes item=userType name=levelkey-|
				<th scope="col">|-$userType.type-|</th>
			|-/foreach-|
			<th scope="col">Todos</th>
		</tr> 
	|-foreach from=$modules item=module name=modulekey-|
		<tr>
			<td>|-$module->getName()-|</td>
			<td>|-$module->getDescription()-|</td>
			<input type=hidden name="modules[]" value="|-$module->getName()-|">	 
		|-foreach from=$userTypes item=userType name=bitlevelgroup-|
			<td class="celldato">
				<input type="checkbox" name="activeModule[|-$module->getName()-|][]" value="|-$userType.bitUser-|" |-checked_if_has_access first=$userType.bitUser second=$module->getAccess()-|>
				<input type=hidden name="bitaction[|-$module->getName()-|][|-$smarty.foreach.contar.iteration-|]" value="|-$userType.bit	User-|">
			</td>
		|-/foreach-|
			<td class="celldato">
				<input type="checkbox" name="all[]" value="|-$module->getName()-|"|-if $levelsave eq $module->getAccess()-|checked|-/if-| />
			</td>
		</tr>		
	 |-/foreach-|
		<tr>
			<td colspan="6">
				<input type="submit" align="right">
			</td>
		</tr>
	</table> 
</form>

