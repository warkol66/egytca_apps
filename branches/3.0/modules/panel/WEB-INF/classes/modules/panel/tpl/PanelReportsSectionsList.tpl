<h2>##common,18,Configuración del Sistema##</h2>
<h1>Administración del Reporte <!--(Versión |-$version-|)-->
<!-- /Link VOLVER -->
</h1>

<div id="panelReportSectionsVersionEdit" style="display:none;">
|-include file="PanelReportsIncludeVersionEdit.tpl"-|
</div>

<p>A continuación podrá editar el reporte.</p>
<div id="div_reportSections">
	|-if $message eq "ok"-|
		<div class="successMessage">Sección guardada correctamente</div>
	|-elseif $message eq "version_ok"-|
		<div class="successMessage">Versión de reporte guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Sección eliminada correctamente</div>
	|-/if-|
	<table border="0" cellpadding="5" cellspacing="0"  class='tableTdBorders nestedTable' id="tabla-reportSections">
		<thead>
		<tr>
			<td colspan="5" class="tdSearch"><div><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar</a></div>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="panelReportsSectionsList" />
					Por tipo<select id="filters[type]" name="filters[type]" title="type">
				<option value="0">Seleccione el tipo</option>
			|-foreach from=$sectionTypes key=typeKey item=type name=for_type-|
				|-if $typeKey gt $configModule->get("reportSections","treeRootType")-|
        <option value="|-$typeKey-|" |-if $typeKey eq $filters.type-|selected="selected" |-/if-|>|-$type-|</option> 
				|-/if-|
			|-/foreach-|
      </select>
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form>|-if $filters|@count gt 0-|<form  method="get">
				<input type="hidden" name="do" value="panelReportsSectionsList" />
				<input type="submit" value="Quitar Filtros" />
		</form>|-/if-|</div></td>
		</tr>
			<tr>
				 <th colspan="5" class="thFillTitle">
				 	<div class="rightLink"><a href="Main.php?do=panelReportsSectionsEdit" class="addNew">Agregar Sección</a></div>
<!--					<div class="rightLink"><a href="#" onclick="$('positionsVersionEdit').show();return false;" class="addNew">Agregar Versión</a></div>
				 	<div class="rightLink"><a href="Main.php?do=positionsVersionsList">Ver Historial de Versiones</a></div>-->
				</th>
			</tr>
			<tr class="thFillTitle">
				<th width="55%">Sección</th>
				<th width="40%">Dentro de</th>
				<th width="5%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-if $reportSections|@count eq 0-|
			<tr>
				 <td colspan="5">|-if isset($filters)-|No hay secciones que concuerden con la búsqueda|-else-|No hay secciones disponibles|-/if-|</td>
			</tr>
		|-else-|
			|-foreach from=$reportSections item=reportSection name=for_positions-|
			|-if $reportSection->getType() gt $configModule->get('reportSections','treeRootType')-|
				<tr class="nestedRow|-$reportSection->getLevel()-|">
					<td>|-$reportSection->getName()-|</td>
					<td>|-$reportSection->getParentName()-|</td>
					<td nowrap>
						<form action="Main.php" method="get" style="display:inline;">
							|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
							|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
							<input type="hidden" name="do" value="panelReportsSectionsEdit" />
							<input type="hidden" name="id" value="|-$reportSection->getid()-|" />
							<input type="submit" name="submit_go_edit_section" value="Editar" class="buttonImageEdit" />
						</form>
						<form action="Main.php" method="post" style="display:inline;">
							|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
							|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
							<input type="hidden" name="do" value="panelReportsSectionsDoDelete" />
							<input type="hidden" name="id" value="|-$reportSection->getid()-|" />
							<input type="submit" name="submit_go_delete_section" value="Borrar" onclick="return confirm('Seguro que desea eliminar la sección?')" class="buttonImageDelete" />
						</form>
						|-if $reportSection->countChildren() > 1 -|
						<form action="Main.php" method="post" style="display:inline;">
							<input type="hidden" name="do" value="commonNestedSetOrderByParent" />
							<input type="hidden" name="entity" value="ReportSection" />
							<input type="hidden" name="nodeId" value="|-$reportSection->getid()-|" />
							<input type="submit" name="submit_go_order_sibblings" value="Ordenar Hijos" class="iconOrder" />
						</form>
						|-/if-|
					</td>
				</tr>
			|-/if-|
			|-/foreach-|						
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="|-if $moduleConfig.useDependencies.value =="YES"-|7|-else-|6|-/if-|" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>
		|-/if-|
			<tr>
				 <th colspan="5" class="thFillTitle">|-if $reportSections|@count gt 5-|<div class="rightLink"><a href="Main.php?do=panelReportsSectionsEdit" class="addNew">Agregar Sección</a></div>|-/if-|</th>
			</tr>
		|-/if-|
		</tbody>
	</table>
</div>


<ul>
</ul>

