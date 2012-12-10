<h2>##blog,1,Blog##</h2>
|-if !is_object($blogTag)-|
<div>Etiqueta no encontrada, puede que haya sido eliminada o esté incorrectamente identificada.<br />
Puede regresar a la página principal de las etiquetas haciendo click <a href="Main.php?do=blogTagsList">aquí</a></div>
|-else-|
<h1>|-if !$blogTag->isNew()-|Editar|-else-|Crear|-/if-| Etiqueta de Entradas</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p>A continuación podrá |-if !$blogTag->isNew()-|editar|-else-|crear|-/if-| una etiqueta de entradas del blog.</p>
<div id="div_tag">
	|-if $message eq "ok"-|
		<div class="successMessage">Etiqueta guardada con éxito</div>
	|-elseif $message eq "error"-|
		<div class="errorMessage">Ha ocurrido un error al intentar guardar la etiqueta</div>
	|-/if-|
<fieldset title="Formulario de edición de datos de una etiqueta">
 <legend>Ingrese los datos de la etiqueta</legend>
	<form action="Main.php" method="post">
	<p><label for="params[name]">Nombre</label>
		<input name="params[name]" type="text" id="params_name" title="Nombre" value="|-$blogTag->getName()-|" size="60" maxlength="100" />
	</p>
	<p>			
				<input type="hidden" name="id" id="id" value="|-$blogTag->getId()-|" />
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="blogTagsDoEdit" />
				<input type="submit" id="button_edit_tag" name="button_edit_tag" title="Aceptar" value="Aceptar" />
				<input type="button" id="button_return_tag" name="button_return_tag" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=blogTagsList'" />
</p>
	</form>
</fieldset>
</div>
|-/if-|
