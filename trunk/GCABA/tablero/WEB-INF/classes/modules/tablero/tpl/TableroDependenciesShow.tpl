<h2>Tablero de Control</h2>
<h1>Dependencias</h1>
<p>A continuación está el listado de depenendencias del sistema. Haga click en lso nombres para ver sus ojetivos.</p>
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	|-foreach from=$dependencies item=dependency name=for_dependencies-|
	<tr>
		<td><a href="Main.php?do=tableroObjectivesShow&dependencyId=|-$dependency->getId()-|">|-$dependency->getName()-|</a>
		</td>
	</tr>
	|-/foreach-|
	|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
	<tr>
		<td class="pages">|-include file="PaginateInclude.tpl"-|</td>
	</tr>
	|-/if-|
</table>
