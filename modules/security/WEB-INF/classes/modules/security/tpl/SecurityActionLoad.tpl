<form name="security" action="Main.php?do=securityActionDoLoad" method="POST"> 
	<table width="75%" border="0" align="center" cellpadding="0" cellspacing="1" class="tablaborde"> 
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
			<td class="celldato">|-$action[0]-|
				<input type=hidden name="action[|-$action[0]-|]" value="|-$action[0]-|" /> 
				<input type=hidden name="modulo[|-$action[0]-|]" value="|-$nombremodulo-|" />
				<input type=hidden name="pare[|-$action[0]-|]" value="|-$action[1]-|" />
			</td>
			<td class="celldato"><input type="checkbox" name="activoaction[|-$action[0]-|]" value="|-$action[0]-|"|-foreach from=$security item=actionsecurity name=act-||-if $action[0] eq $actionsecurity->getAction()-| checked /><input type=hidden name="access[|-$action[0]-|]" value="|-$actionsecurity->getAccess()-|" /> 
				|-/if-|
			|-/foreach-|
			</td> 
		</tr> 
		|-/foreach-| 
	|-/foreach-|
	</table> 
	<input type="submit" name="submit" /> 
</form>
