<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="planningConstructionsShowWorking"></div>
	<div class="innerLighbox">
		<div id="planningConstructionsShowDiv"></div>
	</div>
</div>
<h2>Planificación</h2>
<h1>Administración de Obras</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se muestra la lista de Obras</p>
<div id="div_constructions">
	|-if $message eq "ok"-|
		<div class="successMessage">Obra guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Obra eliminado correctamente</div>
	|-elseif $message eq "saved"-|
		<div class="successMessage">Los cambios fueron guardados</div>
	|-elseif $message eq "notsaved"-|
		<div class="successMessage">No se guardaron los cambios</div>
	|-/if-|
	<table id="tabla-constructions" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
		<tr>
			<td colspan="4" class="tdSearch"><a href="javascript:void(null);" onClick='$("divSearch").toggle();' class="tdTitSearch">Busqueda por nombre</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0 && !($filters.fromStrategicObjectives)-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="planningConstructionsList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />|-if $filters|@count gt 0-|
				<input type='button' onClick='location.href="Main.php?do=planningConstructionsList"' value="Quitar Filtros" title="Quitar Filtros"/>
|-/if-|</form></div></td>
		</tr>
			<tr>
				 <th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=planningConstructionsEdit" class="addLink">Agregar Obra</a></div></th>
			</tr>
			<tr class="thFillTitle">
				<th width="33%">Proyecto</th>
				<th width="33%">Dependencia</th>
				<th width="33%">Obra</th>
				<th width="1%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $planningConstructionColl|@count eq 0-|
			<tr>
				 <td colspan="4">|-if isset($filters)-|No hay Obra que concuerden con la búsqueda|-else-|No hay Obra disponibles|-/if-|</td>
			</tr>
			|-else-|
		|-foreach from=$planningConstructionColl item=construction name=for_constructions-|
			<tr>
				<td>|-assign var=planningProject value=$construction->getPlanningProject()-||-$planningProject-|</td>
				<td>|-if is_object($planningProject)-||-$planningProject->getPosition()-||-/if-|</td>
				<td>|-$construction->getName()-|</td>
				<td nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningConstructionsViewX" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("planningConstructionsShowDiv", "Main.php?do=planningConstructionsViewX&id=|-$construction->getid()-|", { method: "post", parameters: { id: "|-$construction->getId()-|"}, evalScripts: true})};$("planningConstructionsShowWorking").innerHTML = "<span class=\"inProgress\">buscando Obra...</span>";' value="Ver detalle" name="submit_go_show_construction" title="Ver detalle" /></a>
					</form>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningConstructionsEdit" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<input type="submit" name="submit_go_edit_construction" value="Editar" class="icon iconEdit" title="Editar Obra"/>
					</form>
					
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="planningConstructionsDoDelete" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<input type="submit" name="submit_go_delete_construction" value="Borrar" onclick="return confirm('Seguro que desea eliminar el objetivo?')" class="icon iconDelete" title="Eliminar Obra" />
					</form>
					</td>
			</tr>
		|-/foreach-|
		|-/if-|					
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="4" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				<th colspan="4" class="thFillTitle">|-if $planningConstructionColl|@count gt 5-|<div class="rightLink"><a href="Main.php?do=planningConstructionsEdit" class="addLink">Agregar Obra</a></div>|-/if-|</th>
			</tr>
		</tbody>
	</table>
</div>
