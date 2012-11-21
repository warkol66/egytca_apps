<h2>##blog,1,Blog##</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Categoría de Entradas</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p>A continuación podrá |-if !$blogCategory->isNew()-|editar|-else-|crear|-/if-| una categoría de entradas del blog.</p>
<div id="div_category">
	|-if $message eq "error"-|
		<div class="errorMessage">Ha ocurrido un error al intentar guardar la categoría</div>
	|-/if-|
<fieldset title="Formulario de edición de datos de una categoría">
 <legend>Ingrese los datos de la categoría</legend>
	<form action="Main.php" method="post">
	<p><label for="categoryData[name]">Nombre</label>
		<input name="categoryData[name]" type="text" id="categoryData[name]" title="Nombre" value="|-$blogCategory->getName()-|" size="60" maxlength="100" />
	</p>
	<p><label for="categoryData[parentId]">Dentro de</label>
			<select id="categoryData[parentId]" name="categoryData[parentId]" title="Dentro de">
				<option value="0">Ninguna</option>
			|-foreach from=$categories item=categoryForEach name=for_categories-|
				|-if $blogCategory->getId() neq $categoryForEach->getId()-|
        <option value="|-$categoryForEach->getId()-|" |-$blogCategory->getParentId()|selected:$categoryForEach->getId()-|>|-section name=space loop=$categoryForEach->getLevel()-|&nbsp;|-/section-||-$categoryForEach->getName()-|</option>
				|-/if-|
			|-/foreach-|
      </select>
	</p>
	<p>			
				<input type="hidden" name="id" id="id" value="|-$blogCategory->getId()-|" />
				<!--input type="hidden" name="action" id="action" value="|-$action-|" /-->
				<input type="hidden" name="do" id="do" value="blogCategoriesDoEdit" />
				<input type="submit" id="button_edit_category" name="button_edit_category" title="Aceptar" value="Aceptar" />
				<input type="button" id="button_return_category" name="button_return_category" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=blogCategoriesList'" />
</p>
	</form>
</fieldset>
</div>