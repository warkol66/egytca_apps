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
<h1>Administración de Desarrollos</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se muestra la lista de Desarrollo</p>
<div id="div_requerimients">
	|-if $message eq "ok"-|
		<div class="successMessage">Desarrollo guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Desarrollo eliminado correctamente</div>
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
					<input type="hidden" name="do" value="requirementsDevelopmentsList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />|-if $filters|@count gt 0-|
				<input type='button' onClick='location.href="Main.php?do=requirementsDevelopmentsList"' value="Quitar Filtros" title="Quitar Filtros"/>
|-/if-|</form></div></td>
		</tr>|-/if-|
			<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=requirementsDevelopmentsEdit" class="addLink">Agregar Desarrollo</a></div></th>
			</tr>
			<tr class="thFillTitle">
				<th width="25%">Nombre</th>
				<th width="35%">Descripci&oacute;n</th>
				<th width="4%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $developmentColl|@count eq 0-|
			<tr>
				 <td colspan="3">|-if isset($filters)-|No hay Desarrollo que concuerden con la búsqueda|-else-|No hay Desarrollos disponibles|-/if-|</td>
			</tr>
			|-else-|
		|-foreach from=$developmentColl item=development name=for_developments-|
			<tr>
				<td>|-$development-|</td>
				<td>|-$development->getDescription()-|</td>
				<td nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="requirementsDevelopmentsViewX" />
						<input type="hidden" name="id" value="|-$development->getid()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("requirementsShowDiv", "Main.php?do=requirementsDevelopmentsViewX&id=|-$development->getid()-|", { method: "post", parameters: { id: "|-$development->getId()-|"}, evalScripts: true})};$("requirementsShowWorking").innerHTML = "<span class=\"inProgress\">buscando Desarrollo...</span>";' value="Ver detalle" name="submit_go_show_requerimient" title="Ver detalle" /></a>
					</form>
					<form action="Main.php" method="get" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="requirementsDevelopmentsEdit" />
						<input type="hidden" name="id" value="|-$development->getid()-|" />
						<input type="submit" name="submit_go_edit_requerimient" value="Editar" class="icon iconEdit" title="Editar Desarrollo"/>
					</form>
					
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="requirementsDevelopmentsDoDelete" />
						<input type="hidden" name="id" value="|-$development->getid()-|" />
						<input type="submit" name="submit_go_delete_requerimient" value="Borrar" onclick="return confirm('¿Seguro que desea eliminar el Desarrollo?')" class="icon iconDelete" title="Eliminar Desarrollo" />
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
				<th colspan="3" class="thFillTitle">|-if $developmentColl|@count gt 5-|<div class="rightLink"><a href="Main.php?do=requirementsDevelopmentsEdit" class="addLink">Agregar Desarrollo</a></div>|-/if-|</th>
			</tr>
		</tbody>
	</table>
</div>
