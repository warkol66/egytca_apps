|-if !$csv-|<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="planningActivitiesShowWorking"></div>
	<div class="innerLighbox">
		<div id="planningActivitiesShowDiv"></div>
	</div>
</div>
|-include file="CommonAutocompleterInclude.tpl"-|
<h2>Seguimiento</h2>
<h1>Seguimiento de Actividades</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se muestra la lista de Actividades</p>
<div id="div_constructions">
	|-if $message eq "ok"-|
		<div class="successMessage">Actividad guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Actividad eliminada correctamente</div>
	|-elseif $message eq "saved"-|
		<div class="successMessage">Los cambios fueron guardados</div>
	|-elseif $message eq "notsaved"-|
		<div class="successMessage">No se guardaron los cambios</div>
	|-/if-|
	<table id="tabla-constructions" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
		<tr>
			<td colspan="8" class="tdSearch"><a href="javascript:void(null);" onClick='$("divSearch").toggle();' class="tdTitSearch">Buscador</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0 && !($filters.fromStrategicObjectives)-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="panelActivitiesList" />
					<p><label for="filters[searchString]">Texto</label><input name="filters[searchString]" type="text" value="|-$filters.searchString-|" size="30" /></p>
		<!--<div div="div_filters[positionCode]" style="position: relative;z-index:10000;">
					|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_position" url="Main.php?do=commonAutocompleteListX&object=position&objectParam=code" hiddenName="filters[positionCode]" label="Dependencia" defaultValue=$filters.positionName defaultHiddenValue=$filters.positionCode name="filters[positionName]"-|
		</div>
<p><label for="filters[getPositionBrood]">Incluir dependientes</label>
				<input name="filters[getPositionBrood]" type="checkbox" value="1" |-$filters.getPositionBrood|checked_bool-| />
</p>-->
			<p>
					<label for="filters[startingFromDate]">Inicio desde</label>
					<input id="filters[startingFromDate]" name="filters[startingFromDate]" type="text" value="|-$filters.startingFromDate-|" size="12" title="Fecha desde" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[startingFromDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha desde ">
					&nbsp; &nbsp; <label for="filters[startingToDate]" class="inlineLabel">hasta</label>
					<input id="filters[startingToDate]" name="filters[startingToDate]" type="text" value="|-$filters.startingToDate-|" size="12" title="Fecha hasta" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[startingToDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha hasta">
</p>
			<p>
					<label for="filters[endingFromDate]">Vencimiento desde</label>
					<input id="filters[endingFromDate]" name="filters[endingFromDate]" type="text" value="|-$filters.endingFromDate-|" size="12" title="Fecha desde" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[endingFromDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha desde ">
					&nbsp; &nbsp; <label for="filters[endingToDate]" class="inlineLabel">hasta</label>
					<input id="filters[endingToDate]" name="filters[endingToDate]" type="text" value="|-$filters.endingToDate-|" size="12" title="Fecha hasta" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[endingToDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha hasta">
</p>
<p><label for="filters[filterByColor]">Con demora</label>
				<input name="filters[filterByColor]" type="checkbox" value="yellow" |-if $filters.filterByColor eq "yellow"-|checked="checked"|-/if-| title="Mostrar solo actividades con atraso"/>
</p>
				<p><input type='submit' value='Buscar' class='tdSearchButton' />|-if $filters|@count gt 0-|
				&nbsp;&nbsp;<input type='button' onClick='location.href="Main.php?do=panelActivitiesList"' value="Quitar Filtros" title="Quitar Filtros"/>
				&nbsp;&nbsp;<input type="button" value="Exportar" onclick="window.open(('Main.php?'+Form.serialize(this.form)+'&csv=true'));"/>|-/if-|</p>
</form></div></td>
		</tr>
			<!--<tr>
				 <th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=planningActivitiesEdit" class="addLink">Agregar Actividad</a></div></th>
			</tr>-->
			<tr class="thFillTitle">
				<th width="1%">&nbsp;</th>
				<th width="25%">Proyecto/Obra</th>
				<th width="25%">Dependencia</th>
				<th width="20%">Actividad</th>
				<th width="9%">Fecha Inicio</th>
				<th width="9%">Fecha Fin</th>
				<th width="1%">Completado</th>
				<th width="1%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $planningActivityColl|@count eq 0-|
			<tr>
				 <td colspan="8">|-if isset($filters)-|No hay Actividad que concuerden con la búsqueda|-else-|No hay Actividad disponibles|-/if-|</td>
			</tr>
			|-else-|
		|-foreach from=$planningActivityColl item=construction name=for_constructions-|
			<tr>
				<td><a href="javascript:void(null);" class="smallIcon flag|-$construction->statusColor()|capitalize-|"></a></td>
				<td>|-if method_exists($construction,"getProject")-||-assign var=project value=$construction->getProject()-||-else-||-assign var=project value=''-||-/if-||-$project-|</td>
				<td>|-if is_object($project)-||-$project->getPosition()-||-/if-|</td>
				<td>|-$construction->getName()-|</td>
				<td align="center">|-$construction->getStartingDate()|date_format-|</td>
				<td align="center">|-$construction->getEndingDate()|date_format-|</td>
				<td align="center">|-$construction->getAcomplished()|si_no-|</td>
				<td nowrap>
					<!--<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningActivitiesViewX" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("planningActivitiesShowDiv", "Main.php?do=planningActivitiesViewX&id=|-$construction->getid()-|", { method: "post", parameters: { id: "|-$construction->getId()-|"}, evalScripts: true})};$("planningActivitiesShowWorking").innerHTML = "<span class=\"inProgress\">buscando Actividad...</span>";' value="Ver detalle" name="submit_go_show_construction" title="Ver detalle" /></a>
					</form>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningActivitiesEdit" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<input type="submit" name="submit_go_edit_construction" value="Editar" class="icon iconEdit" title="Editar Actividad"/>
					</form>
					-->
					<form action="Main.php" method="post" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="planningActivitiesDoDelete" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<input type="submit" name="submit_go_delete_activity" value="Borrar" onclick="return confirm('¿Seguro que desea eliminar la actividad?')" class="icon iconDelete" title="Eliminar Actividad" />
					</form>
				</td>
			</tr>
		|-/foreach-|
		|-/if-|					
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="8" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<!--<tr>
				<th colspan="8" class="thFillTitle">|-if $planningActivityColl|@count gt 5-|<div class="rightLink"><a href="Main.php?do=planningActivitiesEdit" class="addLink">Agregar Actividad</a></div>|-/if-|</th>
			</tr>-->
		</tbody>
	</table>
</div>
|-else-|
"Eje"|"Proyecto"|"Dependencia"|"Actividad"|"Fecha Inicio"|"Fecha Fin"|"Completado"
|-foreach from=$planningActivityColl item=construction name=for_constructions-||-assign var=project value=$construction->getProject()-|
"|-if is_object($project)-||-$project->getPolicyGuideline()-||-/if-|"|"|-$project-|"|"|-if is_object($project)-||-$project->getPosition()-||-/if-|"|"|-$construction->getName()-|"|"|-$construction->getStartingDate()|date_format-|"|"|-$construction->getEndingDate()|date_format-|"|"|-$construction->getAcomplished()|si_no-|"
|-/foreach-|
|-/if-|