|-include file='ValidationJavascriptInclude.tpl'-|
<h2>Etiquetas</h2>
<h1>|-if $headlineTag->isNew()-|Crear|-else-|Editar|-/if-| Etiquetas</h1>
<div id="div_actor">
	<p>Ingrese los datos del Etiquetas.<br>
<strong>Atención!</strong>: Las estiquetas e utilizan para destacar los textos en los listados de titutlares.<br>
 Las etiqueta sno pueden contener estos caracteres <strong>( "\" - "/" - "'" - "?" - "|" )</strong>.</p>
		|-if $message eq "error"-|
			<div class="errorMessage">Ha ocurrido un error al intentar guardar la Etiqueta</div>
		|-else if $message eq "ok"-|
			<div class="successMessage">Etiquetas guardada correctamente</div>
		|-/if-|
	
	<form name="form_edit_actor" id="form_edit_actor" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un actor">
			<legend>Formulario de Administración de Etiquetas de Titulares</legend>
			|-include file='HeadlinesTagsForm.tpl'-|
				|-if !$headlineTag->isNew()-|
				<input type="hidden" name="id" id="id" value="|-$headlineTag->getid()-|" />
				|-/if-|
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				|-if $page gt 1-| <input type="hidden" name="page" id="page" value="|-$page-|" />|-/if-|
				<input type="hidden" name="do" id="do" value="headlinesTagsDoEdit" />
				|-javascript_form_validation_button value='Guardar' title='Guardar'-|
				<input type="button" id="Regresar" name="cancel" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=headlinesTagsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|'"/>
			</p>
		</fieldset>
	</form>
</div>
