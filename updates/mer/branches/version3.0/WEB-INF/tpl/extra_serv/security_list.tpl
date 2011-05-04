<a href="Main.php?do=actionList">Lista Actions</a> 
<form name="security2" action="Main.php?do=securityDoSave" method="POST"> 
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="tablaborde"> 
		<tr> 
			<th scope="col">Actions</th> 
			|-foreach from=$levels item=level name=levelkey-|
			<th scope="col">|-$level->getName()-|</th> 
			|-/foreach-| 
			<th scope="col">&nbsp;</th> 
			<th scope="col">&nbsp;</th> 
		</tr> 
		|-foreach from=$security item=security name=securities-|
		<tr> 
			<th scope="row">|-$security->getAction()-|</th> 
			<input type=hidden name="actions[]" value="|-$security->getAction()-|"> 
|-foreach from=$levels item=groupbit name=bitlevelgroup-|
<td class="celldato">
	<input type="checkbox" name="activeaction[|-$security->getAction()-|][]" value="|-$groupbit->getBitLevel()-|" |-checked_if_has_access first=$groupbit->getBitLevel() second=$security->getAccess()-|> 
	<input type=hidden name="bitaction[|-$security->getAction()-|][|-$smarty.foreach.contar.iteration-|]" value="|-$groupbit->getBitLevel()-|">
</td>
|-/foreach-|
<td class="celldato">
	<input type=button value="Seleccionar Todos" onClick="this.value=check(activeaction[|-$security->getAction()-|][]-|,true)" />
</td>
<td class="celldato">
	<input type="checkbox" name="all[]" value="|-$security->getAction()-|"|-if $levelsave eq $security->getAccess()-|checked|-/if-| />nivel minimo
</td>
	 </tr>		
	 |-/foreach-|
	</table> 
<input type="submit" name="submit"> 
</form>
