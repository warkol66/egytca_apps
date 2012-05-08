<div id="searchOptions" style="display:|-if $filters neq ''-|block|-else-|none"|-/if-|>
<form action="Main.php" method="get">
<fieldset name="Opciones de busqueda">
	<legend>Buscar documentos</legend>
	<p>Ingrese un texto, palabra o palabras para buscar en los campos específicos.
	</p>
		<p>
			<label>Título</label>
			<input type="input" name="filters[title]" value="|-if isset($filters)-||-$filters.title-||-/if-|" id="title" size="45" />
		</p>
		<p>
			<label>Nombre</label>
			<input type="input" name="filters[filename]" value="|-if isset($filters)-||-$filters.filename-||-/if-|" id="filename" size="35" />
		</p>
		<p>
			<label>Descripción</label>
			<input type="input" name="filters[description]" value="|-if isset($filters)-||-$filters.description-||-/if-|" id="description" size="45" />
		</p>
		<p>
			<label>Fecha Inicial</label>
			<input name="filters[startDate]" type="text" id="filters[startDate]" title="publishDate" value="|-if isset($filters)-||-$filters.startDate-||-/if-|" size="12" /> 
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[startDate]', false, 'ymd', '-');" title="Seleccione la fecha">
		</p>
		<p>
			<label for="publishDate">Fecha Final</label>
			<input name="filters[endDate]" type="text" id="filters[endDate]" title="publishDate" value="|-if isset($filters)-||-$filters.endDate-||-/if-|" size="12" /> 
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[endDate]', false, 'ymd', '-');" title="Seleccione la fecha">
		</p>
		<p><label for="category">Categoría</label>
			<select name="filters[categoryId]">
				<option value"">Seleccione una Categoria</option>
				|-include file="DocumentsCategoriesInclude.tpl" categories=$parentCategories user=$user selectedCategoryId=$filters.categoryId count='0'-|
			</select>
		</p>
		<p>
			<input type="submit" value="Buscar">
			<input type="hidden" name="do" value="documentsList" id="do"> 
			<input type="button" value="Quitar Filtros" onClick="parent.location='Main.php?do=documentsList'">
		</p>
	</fieldset>
	</form>
</div>