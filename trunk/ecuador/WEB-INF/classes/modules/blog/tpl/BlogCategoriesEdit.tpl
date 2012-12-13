<h2>##blog,1,Blog##</h2>
|-if !is_object($blogCategory)-|
<div>Categoría no encontrada, puede que haya sido eliminada o esté incorrectamente identificada.<br />
Puede regresar a la página principal del blog haciendo click <a href="Main.php?do=blogCategoriesList">aquí</a></div>
|-else-|
<h1>|-if !$blogCategory->isNew()-|Editar|-else-|Crear|-/if-| Categoría de Entradas</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p>A continuación podrá |-if !$blogCategory->isNew()-|editar|-else-|crear|-/if-| una categoría de entradas del blog.</p>
<div id="div_category">
	|-if $message eq "ok"-|
		<div class="successMessage">Categoría guardada con éxito</div>
	|-elseif $message eq "error"-|
		<div class="errorMessage">Ha ocurrido un error al intentar guardar la categoría</div>
	|-/if-|
<fieldset title="Formulario de edición de datos de una categoría">
 <legend>Ingrese los datos de la categoría</legend>
	<form action="Main.php" method="post">
	<p><label for="params[name]">Nombre</label>
		<input name="params[name]" type="text" id="params_name" title="Nombre" value="|-$blogCategory->getName()-|" size="60" maxlength="100" />
	</p>
	<p><label for="params[parentId]">Dentro de</label>
			<select id="params_parentId" name="params[parentId]" title="Dentro de">
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
				<input type="hidden" name="action" id="action" value="|-if $blogCategory->isNew()-|create|-else-|edit|-/if-|"/>
				<input type="hidden" name="do" id="do" value="blogCategoriesDoEdit" />
				<input type="submit" id="button_edit_category" name="button_edit_category" title="Aceptar" value="Aceptar" />
				<input type="button" id="button_return_category" name="button_return_category" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=blogCategoriesList'" />
</p>
	</form>
</fieldset>
</div>
|-/if-|
