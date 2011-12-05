<h2>Obras</h2>
<h1>Administración de Obras</h1>
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	|-foreach from=$constructions item=construction name=for_construction-|
	<tr>
		<td width="5%">|-$construction->getId()-|</td>
		<td width="90%">|-$construction->getName()-|</td>
	</tr>
	|-/foreach-|
	|-if isset($pager) && $pager->haveToPaginate()-|
	<tr>
		<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td>
	</tr>
	|-/if-|
</table>
