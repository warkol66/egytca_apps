<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="planningIndicatorsShowWorking"></div>
	<div class="innerLighbox">
		<div id="planningIndicatorsShowDiv"></div>
	</div>
</div>
<h2>Planificación</h2>
<h1>Administración de Indicadores</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se muestra la lista de Indicadores</p>
<div id="div_indicators">
	|-if $message eq "ok"-|
		<div class="successMessage">Indicador guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Indicador eliminado correctamente</div>
	|-elseif $message eq "saved"-|
		<div class="successMessage">Los cambios fueron guardados</div>
	|-elseif $message eq "notsaved"-|
		<div class="successMessage">No se guardaron los cambios</div>
	|-/if-|
	<table id="tabla-indicators" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
		<tr>
			<td colspan="4" class="tdSearch"><a href="javascript:void(null);" onClick='$("divSearch").toggle();' class="tdTitSearch">Busqueda por nombre</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0 && !($filters.fromStrategicObjectives)-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="planningIndicatorsList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />|-if $filters|@count gt 0-|
				<input type='button' onClick='location.href="Main.php?do=planningIndicatorsList"' value="Quitar Filtros" title="Quitar Filtros"/>
|-/if-|</form></div></td>
		</tr>
			<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=planningIndicatorsEdit" class="addLink">Agregar Indicador</a></div></th>
			</tr>
			<tr class="thFillTitle">
				<th width="60%">Indicador</th>
				<th width="39%">Tipo</th>
				<th width="1%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $planningIndicatorColl|@count eq 0-|
			<tr>
				 <td colspan="3">|-if isset($filters)-|No hay Indicador que concuerden con la búsqueda|-else-|No hay Indicador disponibles|-/if-|</td>
			</tr>
			|-else-|
		|-foreach from=$planningIndicatorColl item=indicator name=for_indicators-|
			<tr>
				<td>|-$indicator->getName()-|</td>
				<td>|-$indicator->getIndicatorType()-|</td>
				<td nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningIndicatorsViewX" />
						<input type="hidden" name="id" value="|-$indicator->getid()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("planningIndicatorsShowDiv", "Main.php?do=planningIndicatorsViewX&id=|-$indicator->getid()-|", { method: "post", parameters: { id: "|-$indicator->getId()-|"}, evalScripts: true})};$("planningIndicatorsShowWorking").innerHTML = "<span class=\"inProgress\">buscando Indicador...</span>";' value="Ver detalle" name="submit_go_show_indicator" title="Ver detalle" /></a>
					</form>
					<form action="Main.php" method="get" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="planningIndicatorsEdit" />
						<input type="hidden" name="id" value="|-$indicator->getid()-|" />
						<input type="submit" name="submit_go_edit_indicator" value="Editar" class="icon iconEdit" title="Editar Indicador"/>
					</form>
					<form action="Main.php" method="post" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="planningIndicatorsDoDelete" />
						<input type="hidden" name="id" value="|-$indicator->getid()-|" />
						<input type="submit" name="submit_go_delete_indicator" value="Borrar" onclick="return confirm('Seguro que desea eliminar el objetivo?')" class="icon iconDelete" title="Eliminar Indicador" />
					</form>
					</td>
			</tr>
		|-/foreach-|
		|-/if-|					
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="3" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				<th colspan="3" class="thFillTitle">|-if $indicatorColl|@count gt 5-|<div class="rightLink"><a href="Main.php?do=planningIndicatorsEdit" class="addLink">Agregar Indicador</a></div>|-/if-|</th>
			</tr>
		</tbody>
	</table>
</div>
