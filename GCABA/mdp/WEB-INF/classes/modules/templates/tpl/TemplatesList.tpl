<h2>Plantillas</h2>
<h1>Lista de plantillas disponibles</h1>

<p>Listado de plantillas disponibles</p>

<div id="templateOperationInfo">
|-if $message eq "errorFound"-|
	<div class="failureMessage">Error: No se ha podido realizar su accion</div>
|-elseif $message eq "uploaded"-|
	<div class="successMessage">La plantilla fue subida satisfactoriamente</div> 
|-elseif $message eq "edited"-|
	<div class="successMessage">La plantilla fue editada satisfactoriamente</div> 
|-elseif $message eq "deleted_ok"-|
	<div class="successMessage">La plantilla fue eliminada satisfactoriamente</div> 
|-/if-|
</div>
|-if $templateColl neq ''-|
		<table id="table-templates" width="100%" cellpadding="5" cellspacing="0" class="tableTdBorders">
		<tr>
			<td colspan="5" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar templates</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="templatesList" />
					Texto: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					Resultados por página
				|-html_options name="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$pager->getMaxPerPage()-|	
					<input type="submit" value="Buscar" title="Buscar con los parámetros ingresados" />
				|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=templatesList'"/>|-/if-|
			</form>
			</div></td>
		</tr>
			<tr>
				<th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=templatesEdit&id=|-$docscategory-|" class="addLink" title="Agregar plantilla">Agregar plantilla</a></div></th>
			</tr>
			<tr>
				<th width="5%">Fecha</th>
				<th width="15%">Nombre</th>
				<th width="15%">Archivo</th>
				<th width="34%">Descripción</th>
				<th width="1%">&nbsp;</th>
			</tr>
			|-if $templateColl|@count eq 0-|
			<tr>
				<td colspan="5"> Aun no hay plantillas disponibles</td>
			</tr>
			|-/if-|
			|-foreach from=$templateColl item=template name=template-|

			<tr id="row_|-$template->getId()-|"valign="top">	
				<td nowrap="nowrap">|-$template->getDate()|date_format:"%d-%m-%Y"-|</td>
				<td>|-$template->getName()-|</td>
				<td>|-$template->getRealfilename()-|</td>
				<td>|-$template->getDescription()-|</td>
				<td nowrap="nowrap">

					<form name='templates' action='Main.php' style='display:inline;' method='GET'>
						<input type=hidden name='do' value='templatesEdit'>
						<input type=hidden name='id' value='|-$template->getId()-|'>
						<input type='submit' name='submit' value='##common,1,Editar##' title='##common,1,Editar##' class='icon iconEdit' />
					</form>
				<!-- form de descargar -->
				<form name='templates' action='Main.php?do=templatesDoDownload' style='display:inline;' method='POST'>
					<input type=hidden name='id' value='|-$template->getId()-|'>
					<input type='submit' name='submit' value='##templates,22,Descargar##' title='##templates,25,Descargar##' class='icon iconDownload' />
				</form>

				<!-- form de eliminar -->
				<form name='templates' action='Main.php' style='display:inline;' method='POST'>
					<input type=hidden name='id' value='|-$template->getId()-|'>
					<input type=hidden name='do' value='templatesDoDelete'>
					<input type='submit' name='submit' value='##common,2,Eliminar##' title='##common,2,Eliminar##' class='icon iconDelete' onclick="return confirm('¿Seguro que desea eliminar la plantilla?')" alt="Eliminar" />
				</form>

				</td>
			</tr>
		|-/foreach-|
			<tr>
				<th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=templatesEdit&id=|-$docscategory-|" class="addLink" title="Agregar plantilla">Agregar plantilla</a></div></th>
			</tr>
		</table>
|-/if-|