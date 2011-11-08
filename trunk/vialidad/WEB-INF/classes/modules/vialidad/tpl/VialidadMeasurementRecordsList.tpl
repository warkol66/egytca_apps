<h2>Actas de Medición</h2>
<h1>Administración de Actas de Medición</h1>
<p>A continuación podrá editar la lista de Actas de Medición del sistema.</p>
|-if $message eq "ok"-|
	<div  class="successMessage">Acta de Medición guardada correctamente</div>
|-elseif $message eq "deleted_ok"-|
	<div  class="successMessage">Acta de Medición eliminada</div>
|-elseif $message eq "not_deleted"-|
	<div  class="errorMessage">Ha ocurrido un error al intentar eliminar el Acta de Medición.</div>
|-/if-|
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<thead>
	<tr>
		<td colspan='3' class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda por nombre</a><div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get'>
				<input type="hidden" name="do" value="vialidadMeasurementRecordsList" />
				Nombre: <input name="filters[searchString]" type="text" value="|-$filters.searchString-|" size="30" />
				&nbsp;&nbsp;<input type='submit' value='Buscar' />
				|-if $filters|@count gt 0-|<input name="removeFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=vialidadMeasurementRecordsList'" />|-/if-|
			</form></div></td>
	</tr>
	|-if "vialidadMeasurementRecordsEdit"|security_has_access-|<tr>
		<th colspan="3"><div class="rightLink"><a href="Main.php?do=vialidadMeasurementRecordsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Acta de Medición</a></div></th>
	</tr>|-/if-|
	<tr>
		<th width="50%">Obra</th>
		<th width="40%">Período</th>
		<th width="10%">&nbsp;</th>
	</tr>
	</thead>
	<tbody>
	|-if $records->count() eq 0-|
	<tr><td colspan="3">No hay actas cargadas en el sistema</td></tr>
	|-else-||-foreach from=$records item=record name=for_records-|
	<tr>
		<td>|-$record->getConstruction()-|</td>
		<td>|-$record->getMeasurementDate()|date_format-|</td>
		<td nowrap align="center">
			|-if "vialidadMeasurementRecordsEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
			  <input type="hidden" name="do" value="vialidadMeasurementRecordsEdit" /> 
			  <input type="hidden" name="id" value="|-$record->getId()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_edit_record" value="Editar" class="icon iconEdit" /> 
			</form>|-/if-|
			|-if "vialidadMeasurementRecordsDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
			  <input type="hidden" name="do" value="vialidadMeasurementRecordsDoDelete" /> 
			  <input type="hidden" name="id" value="|-$record->getId()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_delete_record" value="Borrar" onclick="return confirm('Seguro que desea eliminar el Acta de Medición?')" class="icon iconDelete" /> 
			</form>|-/if-|
		</td>
	</tr>
	|-/foreach-||-/if-|
	</tbody>
	<tfoot>
	|-if isset($pager) && $pager->haveToPaginate()-|
	<tr>
		<td colspan="3" class="pages">|-include file="ModelPagerInclude.tpl"-|</td>
	</tr>
	|-/if-|
	|-if "vialidadMeasurementRecordsEdit"|security_has_access && $records|@count gt 5-|<tr>
		<th colspan="3"><div class="rightLink"><a href="Main.php?do=vialidadMeasurementRecordsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Acta de Medición</a></div></th>
	</tr>|-/if-|
	</tfoot>
</table>
