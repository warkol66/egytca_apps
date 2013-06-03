|-block "init"-|
	|-*
	  *
	  * assign $listAction 
	  * assign $editAction
	  * assign $entityName
	  * assign $colCount (needed for correct positioning of some items)
	  * assign itemName: name for an entity item
	  *
	  *-|
|-/block-|
|-$listAction = $listAction|lcfirst-|
|-$editAction = $editAction|lcfirst-|
|-$entityName = $entityName|lcfirst-|

|-capture name="newItemBox"-|
	|-block "newItemBox"-|
		|-if $editAction|security_has_access-|
			<tr>
				<th colspan="|-$colCount-|">
					<div class="rightLink">
						<a href="Main.php?do=|-$editAction-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar |-$itemName|default:'Item'-|</a>
					</div>
				</th>
			</tr>
		|-/if-|
	|-/block-|
|-/capture-|

|-block "beforeTable"-|
	|-*
	  *
	  * everything before the table goes here
	  *
	  *-|
|-/block-|
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	|-block "colGroup"-|
		|-*
		  *
		  * <colgroup>'s go here
		  *
		  *-|
	|-/block-|
	<thead>
		|-block "thead"-|
			|-block "filtersBox"-|
				<tr>
					<td colspan="|-$colCount-|" class="tdSearch">
						<a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar</a>
						<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
							<form action='Main.php' method='get'>
								<input type="hidden" name="do" value="|-$listAction-|" />
								|-block "filters"-|
									|-*
									  *
									  * filters go here
									  *
									  *-|
								|-/block-|
								<input id="button_filtersSubmit" type='submit' value='Buscar' />
								|-if $filters|@count gt 0-|
									<input name="removeFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=|-$listAction-|'" />
								|-/if-|
							</form>
						</div>
					</td>
				</tr>
			|-/block-|
			|-$smarty.capture.newItemBox-|
			<tr>
				|-block "ths"-|
					|-*
					  *
					  * <th>'s go here
					  *
					  *-|
				|-/block-|
			</tr>
		|-/block-|
	</thead>
	<tbody>
		|-$entityColl = $|-$entityName-|Coll-|
		|-foreach from=$entityColl item=$entityName-|
			<tr>
				|-block "tds"-|
					|-*
					  *
					  * <td>'s go here
					  *
					  *-|
				|-/block-|
			</tr>
		|-foreachelse-|
			<tr><td colspan="|-$colCount-|">|-block "noItemsMsg"-|No hay items que mostrar|-/block-|</td></tr>
		|-/foreach-|
	</tbody>
	<tfoot>
		|-if isset($pager) && $pager->haveToPaginate()-|
			<tr>
				<td colspan="|-$colCount-|" class="pages">|-include file="ModelPagerInclude.tpl"-|</td>
			</tr>
		|-/if-|
		|-if $entityColl|@count gt 5-|
			|-$smarty.capture.newItemBox-|
		|-/if-|
	</tfoot>
</table>
|-block "afterTable"-|
	|-*
	  *
	  * everything after the table goes here
	  *
	  *-|
|-/block-|
