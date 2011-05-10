<h2>Indicadores</h2>
<h1>Administración de Indicadores
	<!-- /Link VOLVER -->
</h1>
<p>A continuación podrá editar la lista de indicadores del sistema.</p>
<div id="div_indicators"> |-if $message eq "ok"-|
	<div class="successMessage">Indicador guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
	<div class="successMessage">Indicador eliminado correctamente</div>
	|-/if-|
	<table border="0" cellpadding="5" cellspacing="0"  class='tableTdBorders' id="tabla-indicators">
		<thead>
			<tr>
				<td colspan="3" class="tdSearch"><div><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar</a></div>
					<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
						<form action='Main.php' method='get' style="display:inline;">
						<p>
							Por Categoría
							<select id="filters[category]" name="filters[category]" title="Categoría">
								<option value="0">Seleccione categoría</option>
								|-foreach from=$indicatorsCategories key=categoryKey item=category name=for_category-|
								<option value="|-$category->getId()-|" |-if $category->getId() eq $filters.category-|selected="selected" |-/if-|>|-$category->getName()-|</option>
								|-/foreach-|
							</select>
							Por tipo
							<select id="filters[type]" name="filters[type]" title="Tipo">
								<option value="0">Seleccione el tipo</option>
								|-foreach from=$indicatorsTypes key=typeKey item=type name=for_type-|
								<option value="|-$typeKey-|" |-if $typeKey eq $filters.type-|selected="selected" |-/if-|>|-$type-|</option>
							|-/foreach-|
							</select>
							Nombre:
							<input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" /></p>
							<p>
							<input type="hidden" name="do" value="indicatorsList" />
							<input type='submit' value='Buscar' class='tdSearchButton' />
							<input type="button" title="Quitar Filtros" value="Quitar Filtros" onClick="location.href='Main.php?do=indicatorsList'" /><p>
						</form>
					</div></td>
			</tr>
			<tr>
				<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=indicatorsEdit" class="addNew">Agregar Indicador</a></div></th>
			</tr>
			<tr>
<!--				<th width="5%" class="thFillTitle">Id</th>   -->
				<th width="80%" class="thFillTitle">Nombre</th>
				<th width="10%" class="thFillTitle">Tipo</th>
				<th width="5%" class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-if $indicators|@count eq 0-|
		<tr>
			<td colspan="3">|-if isset($filters)-|No hay indicadores que concuerden con la búsqueda|-else-|No hay Indicadores disponibles|-/if-|</td>
		</tr>
		|-else-|
		|-foreach from=$indicators item=indicator name=for_indicators-|
		<tr>
<!--			<td>|-$indicator->getid()-|</td>-->
			<td>|-$indicator->getname()-|</td>
			<td>|-$indicator->getIndicatorTypeTranslated()-|</td>
			<td nowrap><form action="Main.php" method="get" style="display:inline;">
					<input type="hidden" name="do" value="indicatorsView" />
					<input type="hidden" name="id" value="|-$indicator->getid()-|" />
					<input type="submit" name="submit_go_edit_indicator" value="Ver Gráfico" class="buttonImageGraph" title="Ver Gráfico" />
				</form>
				<form action="Main.php" method="get" style="display:inline;">
					<input type="hidden" name="do" value="indicatorsEdit" />
					<input type="hidden" name="id" value="|-$indicator->getid()-|" />
					<input type="submit" name="submit_go_edit_indicator" value="Editar" class="buttonImageEdit" title="Editar" />
				</form>
				<form action="Main.php" method="post" style="display:inline;">
					<input type="hidden" name="do" value="indicatorsDoDelete" />
					<input type="hidden" name="id" value="|-$indicator->getid()-|" />
					<input type="submit" name="submit_go_delete_indicator" value="Borrar" title="Borrar" onclick="return confirm('Seguro que desea eliminar el indicador?')" class="buttonImageDelete" />
				</form>
			</td>
		</tr>
		|-/foreach-|						
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr>
			<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td>
		</tr>
		|-/if-|
		<tr>
			<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=indicatorsEdit" class="addNew">Agregar Indicador</a></div></th>
		</tr>
		|-/if-|
		</tbody>
		
	</table>
</div>
