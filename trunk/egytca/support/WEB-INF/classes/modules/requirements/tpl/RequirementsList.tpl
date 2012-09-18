<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="requirementsShowWorking"></div>
	<div class="innerLighbox">
		<div id="requirementsShowDiv"></div>
	</div>
</div> 
<h2>Planificación</h2>
<h1>Administración de Requerimientos</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se muestra la lista de Requerimiento</p>
<div id="div_requerimients">
	|-if $message eq "ok"-|
		<div class="successMessage">Requerimiento guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Requerimiento eliminado correctamente</div>
	|-elseif $message eq "saved"-|
		<div class="successMessage">Los cambios fueron guardados</div>
	|-elseif $message eq "notsaved"-|
		<div class="successMessage">No se guardaron los cambios</div>
	|-/if-|

	
	<table id="tabla-requerimients" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
		|-if !$nav-|<tr>
			<td colspan="3" class="tdSearch"><a href="javascript:void(null);" onClick='$("divSearch").toggle();' class="tdTitSearch">Busqueda por nombre</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="requirementsList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />|-if $filters|@count gt 0-|
				<input type='button' onClick='location.href="Main.php?do=requirementsList"' value="Quitar Filtros" title="Quitar Filtros"/>
|-/if-|</form></div></td>
		</tr>|-/if-|
			<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=requirementsEdit" class="addLink">Agregar Requerimiento</a></div></th>
			</tr>
			<tr class="thFillTitle">
				<th width="25%">Nombre</th>
				<th width="35%">Descripci&oacute;n</th>
				<th width="4%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $requirementColl|@count eq 0-|
			<tr>
				 <td colspan="3">|-if isset($filters)-|No hay Requerimiento que concuerden con la búsqueda|-else-|No hay Requerimientos disponibles|-/if-|</td>
			</tr>
			|-else-|
		|-foreach from=$requirementColl item=requirement name=for_requirements-|
			<tr>
				<td>|-$requirement-|</td>
				<td>|-$requirement->getDescription()-|</td>
				<td nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="requirementsViewX" />
						<input type="hidden" name="id" value="|-$requirement->getid()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("requirementsShowDiv", "Main.php?do=requirementsViewX&id=|-$requirement->getid()-|", { method: "post", parameters: { id: "|-$requirement->getId()-|"}, evalScripts: true})};$("requirementsShowWorking").innerHTML = "<span class=\"inProgress\">buscando Requerimiento...</span>";' value="Ver detalle" name="submit_go_show_requerimient" title="Ver detalle" /></a>
					</form>
					<form action="Main.php" method="get" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="requirementsEdit" />
						<input type="hidden" name="id" value="|-$requirement->getid()-|" />
						<input type="submit" name="submit_go_edit_requerimient" value="Editar" class="icon iconEdit" title="Editar Requerimiento"/>
					</form>
					
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="requirementsDoDelete" />
						<input type="hidden" name="id" value="|-$requirement->getid()-|" />
						<input type="submit" name="submit_go_delete_requerimient" value="Borrar" onclick="return confirm('¿Seguro que desea eliminar el Requerimiento?')" class="icon iconDelete" title="Eliminar Requerimiento" />
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
				<th colspan="3" class="thFillTitle">|-if $requirementColl|@count gt 5-|<div class="rightLink"><a href="Main.php?do=requirementsEdit" class="addLink">Agregar Requerimiento</a></div>|-/if-|</th>
			</tr>
		</tbody>
	</table>
</div>
