|-foreach from=$levels item=groupbit name=bitlevelgroup-|
<td>
	<input type="checkbox" name="activeaction[|-$security->getAction()-|][]" value="|-$groupbit->getBitLevel()-|" |-checked_if_has_access first=$groupbit->getBitLevel() second=$security->getAccess()-|> 
	<input type=hidden name="bitaction[|-$security->getAction()-|][|-$smarty.foreach.contar.iteration-|]" value="|-$groupbit->getBitLevel()-|">
</td>
|-/foreach-|
<td>
	<input type=button value="Seleccionar Todos" onClick="this.value=check(activeaction[|-$security->getAction()-|][]-|,true)" />
</td>
<td>
	<input type="checkbox" name="all[]" value="|-$security->getAction()-|"|-if $levelsave eq $security->getAccess()-|checked|-/if-| />nivel minimo
</td>
