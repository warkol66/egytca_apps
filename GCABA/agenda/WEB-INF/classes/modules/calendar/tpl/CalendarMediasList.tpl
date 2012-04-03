<h2>Imágenes</h2>
<h1>Administrar Imágenes</h1>
<p>A continuación puede ver las imágenes asociadas a los eventos publicados.</p>

<div id="div_messages">
	|-if $message eq "ok"-|<div class="successMessage">Imagen guardada correctamente</div>|-/if-|
	|-if $message eq "deleted_ok"-|<div class="successMessage">Imagen eliminada correctamente</div>|-/if-|
</div>

<div id="div_calendarmedias_filters">
	<fieldset>
			<legend>Filtros</legend>
			<form action="Main.php" method="get">
				<p>
					<label for="categoryId">Categoria Evento</label>
					<select name='filters[categoryId]'>
							<option value=''>Seleccione una categoria</option>
						|-foreach from=$categories item=category name=from_categories-|
							<option value="|-$category->getId()-|" |-if $filters neq '' and $filters.categoryId eq $category->getId()-|selected="selected"|-/if-|>|-$category->getName()-|</option>
						|-/foreach-|
					</select>
				</p>				
					<input type="hidden" name="do" value="calendarMediasList" id="do">
					<input type="submit" value="Aplicar Filtro">
				</p>
			</form>
	</fieldset>
</div>
<div id="div_calendarmedias">
	<table cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-calendarmedias">
		<thead>
			<tr>
				<th colspan="7" class="thFillTitle"><!--<div class="rightLink"> <a href="Main.php?do=calendarMediasEdit" class="addLink">Agregar Imagen</a></div>--></th> 
			</tr>
			<tr>
				<th>Evento</th>
				<th>Nombre Archivo</th>
				<th>Tipo de Archivo</th>
				<th>Fecha de Creación</th>
				<th>Estado</th>
				<th>Usuario</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$calendarMedias item=calendarMedias name=for_calendarMedias-|
			<tr>
		 	  	<td>|-if $calendarMedias->getCalendarEvent() gt 0-||-assign var=event value=$calendarMedias->getCalendarEvent()-||-$event->getTitle()-||-/if-|</td>
				<td>|-$calendarMedias->getname()-|</td>
				<td>|-$calendarMedias->getmediaTypeName()-|</td>
				<td>|-$calendarMedias->getcreationDate()-|</td>
				<td>|-$calendarMedias->getstatus()-|</td>
				<td>
					|-assign var=currentUser value=$calendarMedias->getUser()-|
					|-if not empty($currentUser)-|
						|-$currentUser->getUsername()-|
					|-/if-|				</td>
				<td>
					<form action="Main.php" method="get">
						<!--pasaje de parametros de filtros -->
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						
						<input type="hidden" name="do" value="calendarMediasEdit" />
						<input type="hidden" name="id" value="|-$calendarMedias->getid()-|" />
						<input type="submit" name="submit_go_edit_calendarMedia" value="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="calendarMediasDoDelete" />
						<input type="hidden" name="id" value="|-$calendarMedias->getid()-|" />
						<input type="submit" name="submit_go_delete_calendarMedia" value="Borrar" onclick="return confirm('Seguro que desea eliminar el calendarMedia?')" class="icon iconDelete" />
					</form>				
					</td>
			</tr>
		|-/foreach-|						
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="7" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
			<tr>
				<th colspan="7" class="thFillTitle"><!-- <div class="rightLink"><a href="Main.php?do=calendarMediasEdit" class="addLink">Agregar Imagen</a></div>--></th> 
			</tr>
		</tbody>
	</table>
</div>
