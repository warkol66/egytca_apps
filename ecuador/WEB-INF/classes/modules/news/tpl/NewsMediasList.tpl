<h2>Multimedia</h2>
<h1>Administrar contenido Multimedia</h1>
<p>A continuación puede ver el contenido multimedia asociado a los artículos publicados.</p>

<div id="div_messages">
	|-if $message eq "ok"-|<div class="successMessage">Media guardado correctamente</div>|-/if-|
	|-if $message eq "deleted_ok"-|<div class="successMessage">Media eliminado correctamente</div>|-/if-|
</div>

<div id="div_newsmedias_filters">
	<fieldset>
			<legend>Filtros de Comentarios</legend>
			<form action="Main.php" method="get">
				<p>
					<label for="fromDate">Fecha de Articulo Desde</label>
					<input name="filters[fromDate]" type="text" id="fromDate" title="fromDate" value="|-$filters.fromDate-|" size="12" /> 
					<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[fromDate]', false, 'ymd', '-');" title="Seleccione la fecha">
				</p>
				<p>
					<label for="toDate">Fecha de Articulo Hasta</label>
					<input name="filters[toDate]" type="text" id="toDate" title="toDate" value="|-$filters.toDate-|" size="12" /> 
					<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[toDate]', false, 'ymd', '-');" title="Seleccione la fecha">
				</p>
				<p>
					<label for="categoryId">Categoria Articulo</label>
					<select name='filters[categoryId]'>
							<option value=''>Seleccione una categoria</option>
						|-foreach from=$categories item=category name=from_categories-|
							<option value="|-$category->getId()-|" |-if $filters neq '' and $filters.categoryId eq $category->getId()-|selected="selected"|-/if-|>|-$category->getName()-|</option>
						|-/foreach-|
					</select>
				</p>				
				<p>
					<label for="mediaType">Tipo</label>
					<select name='filters[mediaType]'>
							<option value=''>Seleccione un tipo</option>
						|-foreach from=$mediaTypes key=key item=typeName name=from_types-|
							<option value="|-$key-|" |-if $filters neq '' and $filters.mediaType eq $key-|selected="selected"|-/if-|>|-$typeName-|</option>
						|-/foreach-|
					</select>
				</p>
					<input type="hidden" name="do" value="newsMediasList" id="do">
					<input type="submit" value="Aplicar Filtro">
				</p>
			</form>
	</fieldset>
</div>
<div id="div_newsmedias">
	<table cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-newsmedias">
		<thead>
			<tr>
				<th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=newsMediasEdit" class="addLink">Agregar Media</a></div></th>
			</tr>
			<tr>
				<th>Artículo</th>
				<th>Nombre Archivo</th>

				<th>Tipo de Archivo</th>
				<th>Fecha de Creación</th>
				<th>Estado</th>
				<th>Usuario</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$newsmedias item=newsmedia name=for_newsmedias-|
			<tr>

				<td>|-if $newsmedia->getNewsArticle() gt 0-||-assign var=article value=$newsmedia->getNewsArticle()-||-$article->getTitle()-||-/if-|</td>
				<td>|-$newsmedia->getname()-|</td>
				<td>|-$newsmedia->getmediaTypeName()-|</td>
				<td>|-$newsmedia->getcreationDate()-|</td>
				<td>|-$newsmedia->getstatus()-|</td>
				<td>
					|-assign var=currentUser value=$newsmedia->getUser()-|
					|-if not empty($currentUser)-|
						|-$currentUser->getUsername()-|
					|-/if-|				</td>
				<td>
					<form action="Main.php" method="get">
						<!--pasaje de parametros de filtros -->
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						
						<input type="hidden" name="do" value="newsMediasEdit" />
						<input type="hidden" name="id" value="|-$newsmedia->getid()-|" />
						<input type="submit" name="submit_go_edit_newsmedia" value="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="newsMediasDoDelete" />
						<input type="hidden" name="id" value="|-$newsmedia->getid()-|" />
						<input type="submit" name="submit_go_delete_newsmedia" value="Borrar" onclick="return confirm('Seguro que desea eliminar el newsmedia?')" class="icon iconDelete" />
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
				<th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=newsMediasEdit" class="addLink">Agregar Media</a></div></th>
			</tr>
		</tbody>
	</table>
</div>
