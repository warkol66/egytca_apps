|-if $moduleView ne 'todos' -|<h3>Seguridad del módulo |-$moduleView-|</h3>
|-else-|<h3>Seguridad de |-$moduleView-| los módulos</h3>
|-/if-|
<form name="securityFilter" id="securityFilter" action="Main.php" method="get">
		 <tr class="row_even">
			 <td nowrap class="style6">Seleccion de modulo:&nbsp;</td>
			 <td>
				<select name="module" size="1"  class="TXTnormal" onchange="if (this.options[this.selectedIndex].value) document.forms.securityFilter.submit()">
				<option value='todos'>Todos</option>
				|-foreach from=$modulesName item=moduleName-|
					<option value="|-$moduleName-|"> |-$moduleName-|</option>
				|-/foreach-|
				</select>
				<input type="hidden" name="do" value="securityActionListAffiliateUser" />
			 </td>
			 <td><input type="submit"> </td>
		 </tr>
</form>



<a href="Main.php?do=securityActionLoad">Lista Actions</a> 
<form name="security2" action="Main.php?do=securityActionDoSaveByAffiliate" method="POST">
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="tablaborde">
		<tr> 
			<th scope="col">Actions</th> 
			|-foreach from=$levels item=level name=levelkey-|
				<th scope="col">|-$level->getName()-|</th>
			|-/foreach-|
			<th scope="col">Todos</th>
		</tr> 
		|-foreach from=$actions item=action name=for_actions-|
		<tr>
			<th scope="row">|-$action->getAction()-|
			<input type=hidden name="actions[]" value="|-$action->getAction()-|">
			</th> 
|-foreach from=$levels item=groupbit name=bitlevelgroup-|
<td class="celldato">
	<input type="checkbox" name="activeaction[|-$action->getAction()-|][]" value="|-$groupbit->getBitLevel()-|" |-checked_if_has_access first=$groupbit->getBitLevel() second=$action->getAccessAffiliateUser()-|>
	<input type=hidden name="bitaction[|-$action->getAction()-|][|-$smarty.foreach.contar.iteration-|]" value="|-$groupbit->getBitLevel()-|">
</td>
|-/foreach-|
<td class="celldato">
	<input type="checkbox" name="all[]" value="|-$action->getAction()-|"|-if $levelsave eq $action->getAccessAffiliateUser()-|checked|-/if-| />
</td>
	 </tr>		
	 |-/foreach-|
	</table> 
<input type="submit">
</form>
