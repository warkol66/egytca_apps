<h2>Curvas de Desembolso</h2>
<h1>Administración de Curvas de Desembolso de |-$contract->getName()-|
	<!-- /Link VOLVER -->
</h1>
<p>A continuación podrá editar la lista de Curvas de Desembolso de  |-$contract->getName()-|.</p>
<div id="div_indicators"> |-if $message eq "ok"-|
	<div class="successMessage">Curva de Desembolso guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
	<div class="successMessage">Curva de Desembolso eliminado correctamente</div>
	|-/if-|
	<table border="0" cellpadding="5" cellspacing="0"  class='tableTdBorders' id="tabla-indicators">
		<thead>
			<tr>
				<td colspan="3" class="tdSearch"><div><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar</a></div>
					<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
						<form action='Main.php' method='get' style="display:inline;">
						<p>
							Nombre:
							<input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" /></p>
							<p>
							<input type="hidden" name="do" value="indicatorsList" />
							<input type="hidden" name="contractId" value="|-$contract->getId()-|" />
							<input type='submit' value='Buscar' class='tdSearchButton' />
							<input type="button" title="Quitar Filtros" value="Quitar Filtros" onClick="location.href='Main.php?do=indicatorsList'" /><p>
						</form>
					</div></td>
			</tr>
			<tr>
				<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=indicatorsEdit&contractId=|-$contract->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Curva de Desembolso</a></div></th>
			</tr>
			<tr>
<!--				<th width="5%" class="thFillTitle">Id</th>   -->
				<th width="80%" class="thFillTitle">Nombre</th>
				<th width="5%" class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-if $indicators|@count eq 0-|
		<tr>
			<td colspan="3">|-if isset($filters)-|No hay Cursvas de Desembolso que concuerden con la búsqueda|-else-|No hay Cursvas de Desembolso disponibles|-/if-|</td>
		</tr>
		|-else-|
		|-foreach from=$indicators item=indicator name=for_indicators-|
		<tr>
<!--			<td>|-$indicator->getid()-|</td>-->
			<td>|-$indicator->getname()-|</td>
			<td nowrap><form action="Main.php" method="get" style="display:inline;">
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-|<input type="hidden" name="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="do" value="indicatorsView" />
					<input type="hidden" name="id" value="|-$indicator->getid()-|" />
					<input type="submit" name="submit_go_edit_indicator" value="Ver Gráfico" class="icon iconGraph" title="Ver Gráfico" />
				</form>
				<form action="Main.php" method="get" style="display:inline;">
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-|<input type="hidden" name="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="do" value="indicatorsEdit" />
					<input type="hidden" name="id" value="|-$indicator->getid()-|" />
					<input type="submit" name="submit_go_edit_indicator" value="Editar" class="icon iconEdit" title="Editar" />
				</form>
				<form action="Main.php" method="post" style="display:inline;">
					<input type="hidden" name="do" value="indicatorsDoDelete" />
					<input type="hidden" name="id" value="|-$indicator->getid()-|" />
					<input type="submit" name="submit_go_delete_indicator" value="Borrar" title="Borrar" onclick="return confirm('Seguro que desea eliminar el indicador?')" class="icon iconDelete" />
				</form>
			</td>
		</tr>
		|-/foreach-|						
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr>
			<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td>
		</tr>
		|-/if-|
		<tr>
			<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=indicatorsEdit&contractId=|-$contract->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Curva de Desembolso</a></div></th>
		</tr>
		|-/if-|
		</tbody>
		
	</table>
</div>
