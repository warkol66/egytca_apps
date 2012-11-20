<h2>##blog,1,Blog##</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Etiqueta de Entradas</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
|-if isset($exists)-|
<div>Etiqueta no encontrada, puede que haya sido eliminada o esté incorrectamente identificada.<br />
Puede regresar a la página principal de las etiquetas haciendo click <a href="Main.php?do=blogTagsList">aquí</a></div>
|-else-|
<p>A continuación podrá |-if $action eq "edit"-|editar|-else-|crear|-/if-| una etiqueta de entradas del blog.</p>
<div id="div_tag">
	|-if $message eq "error"-|
		<div class="errorMessage">Ha ocurrido un error al intentar guardar la etiqueta</div>
	|-/if-|
<fieldset title="Formulario de edición de datos de una etiqueta">
 <legend>Ingrese los datos de la etiqueta</legend>
	<form action="Main.php" method="post">
	<p><label for="tagData[name]">Nombre</label>
		<input name="tagData[name]" type="text" id="tagData[name]" title="Nombre" value="|-$tag->getName()-|" size="60" maxlength="100" />
	</p>
	<p>			
				<input type="hidden" name="id" id="id" value="|-$tag->getId()-|" />
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="blogTagsDoEdit" />
				<input type="submit" id="button_edit_tag" name="button_edit_tag" title="Aceptar" value="Aceptar" />
				<input type="button" id="button_return_tag" name="button_return_tag" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=blogTagsList'" />
</p>
	</form>
</fieldset>
</div>
|-/if-|
