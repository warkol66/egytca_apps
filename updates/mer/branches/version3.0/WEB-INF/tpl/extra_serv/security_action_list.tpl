<form name="security" action="Main.php?do=actionDoList" method="POST"> 
	<table width="75%" border="0" align="center" cellpadding="0" cellspacing="1" class="tableTdBorders"> 
		<tr> 
			<th scope="col">Actions</th> 
			<th scope="col">Activar</th> 
		</tr> 
		|-foreach from=$modulos item=modulo name=modulokey key=nombremodulo-|
		<tr> 
			<th colspan="2">|-$nombremodulo-|</th> 
		</tr> 
		|-foreach from=$modulo item=action name=actionf-|
		<tr> 
			<td class="celldato">|-$action-|
				<input type=hidden name="action[|-$action-|]" value="|-$action-|" /> 
				<input type=hidden name="modulo[|-$action-|]" value="|-$nombremodulo-|" />
			</td>
			<td class="celldato"><input type="checkbox" name="activoaction[|-$action-|]" value="|-$action-|"|-foreach from=$security item=actionsecurity name=act-||-if $action eq $actionsecurity->getAction()-| checked /><input type=hidden name="access[|-$action-|]" value="|-$actionsecurity->getAccess()-|" /> 
				|-/if-|
			|-/foreach-|
			</td> 
		</tr> 
		|-/foreach-| 
	|-/foreach-|
	</table> 
	<input type="submit" name="submit" /> 
</form>
