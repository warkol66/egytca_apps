<div id="searchOptions" style="display:|-if $filters neq ''-|block|-else-|none|-/if-|;">
<form action="Main.php" method="get">
<fieldset name="Opciones de busqueda">
	<legend>##documents,9,Buscar documentos##</legend>
	<p>##documents,19,Ingrese un texto, palabra o palabras para buscar en los campos específicos.##</p>
		<p>
			<label for="filters[textSearch]">Texto a buscar</label>
			<input type="input" name="filters[textSearch]" value="|-if isset($filters)-||-$filters.textSearch-||-/if-|" id="title" size="45" />
		</p>
	<p>##documents,18,Ingrese un texto, palabra o palabras para buscar en todos los campos disponibles.##</p>
		<p>
			<label for="filters[title]">##documents,12,Título##</label>
			<input type="input" name="filters[title]" value="|-if isset($filters)-||-$filters.title-||-/if-|" id="title" size="45" />
		</p>
		<p>
			<label for="filters[filename]">##documents,13,Nombre##</label>
			<input type="input" name="filters[filename]" value="|-if isset($filters)-||-$filters.filename-||-/if-|" id="filename" size="35" />
		</p>
		<p>
			<label for="filters[description]">##documents,14,Descripción##</label>
			<input type="input" name="filters[description]" value="|-if isset($filters)-||-$filters.description-||-/if-|" id="description" size="45" />
		</p>
|-if $configModule->get('documents','useAuthors')-|		<p>
			<label for="filters[author]">##documents,15,Autor(es)##</label>
			<input type="input" name="filters[author]" value="|-if isset($filters)-||-$filters.author-||-/if-|" id="author" size="45" />
		</p>|-/if-|
|-if $configModule->get('documents','useKeywords')-|		<p>
			<label for="filters[keyWords]">##documents,16,Palabra clave##</label>
			<input type="input" name="filters[keyWords]" value="|-if isset($filters)-||-$filters.keyWords-||-/if-|" id="keyWords" size="45" />
		</p>|-/if-|
	<!--	<p>
			<label for="filters[startDate]">##documents,22,Fecha Inicial##</label>
			<input name="filters[startDate]" type="text" id="filters[startDate]" title="publishDate" value="|-if isset($filters)-||-$filters.startDate-||-/if-|" size="12" /> 
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[startDate]', false, 'ymd', '-');" title="Seleccione la fecha">
		</p>
		<p>
			<label for="filters[endDate]">##documents,23,Fecha Final##</label>
			<input name="filters[endDate]" type="text" id="filters[endDate]" title="publishDate" value="|-if isset($filters)-||-$filters.endDate-||-/if-|" size="12" /> 
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[endDate]', false, 'ymd', '-');" title="Seleccione la fecha">
		</p>-->
		|-if $parentCategories|count gt 0-|<p><label for="filters[categoryId]">##documents,21,Categoría##</label>
			<select name="filters[categoryId]">
				<option value"">Seleccione una Categoría</option>
				|-include file="DocumentsCategoriesInclude.tpl" categories=$parentCategories user=$user selectedCategoryId=$filters.categoryId count='0'-|
			</select>
		</p>|-/if-|
		<p>
			<input type="submit" value="##documents,20,Buscar##">
			<input type="hidden" name="do" value="|-$do-|" id="do"> 
			<input type="button" value="##documents,24,Quitar Filtros##" onClick="parent.location='Main.php?do=|-$do-|'">
		</p>
	</fieldset>
	</form>
</div>