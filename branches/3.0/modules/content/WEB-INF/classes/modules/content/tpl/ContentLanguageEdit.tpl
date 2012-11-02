
<h2>Módulo de Contenido</h2>
|-if !$notValidId-|
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Idioma</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p>A continuación podrá |-if $action eq "edit"-|editar|-else-|crear|-/if-| un Idioma.</p>
<div id="div_idioma">
	|-if $message eq "error"-|
		<div class="errorMessage">Ha ocurrido un error al intentar guardar el Curva de Desembolso</div>
	|-/if-|
	<fieldset title="Formulario de edición de datos de un Curva de Desembolso">
		<legend>Idioma</legend>
		<form action="Main.php" method="post">
			<p><label for="params[name]">Nombre</label>
				<input name="params[name]" type="text" class="emptyValidation" id="params[name]" title="Nombre" value="|-if $action eq 'edit'-||-$idioma->getName()-||-/if-|" size="60" maxlength="100" />
			</p>


			<p>
				<label for="params[languagecode]">Código </label>
					<input name="params[languageCode]" type="text" id="params[languageCode]" class="emptyValidation" title="Código" value="|-if $action eq 'edit'-||-$idioma->getLanguagecode()-||-/if-|" size="8" maxlength="30" />
			</p>

			<p>

			<label for="params[active]">Activo </label>
			<input name="params[active]" type="checkbox" id="params[active]" title="Activo" value="1" |-if $action eq 'edit' && $idioma->getActive()-|checked="checked"|-/if-|/>

			</p>




			<p>
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="contentLanguageDoEdit" />
				<input type="hidden" name="id" id="id" value="|-$smarty.request.id-|" />
				|-if !$show && !$showLog-|<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>|-/if-|
				<br>
				|-javascript_form_validation_button value=Aceptar-|

				<input type="button" id="button_return_idioma" name="button_return_idioma" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=contentLanguagesList'" />

		</form>
	</fieldset>
</div>
	|-if $action == "edit"-|
	|-/if-|
	|-else-|
<div class="errorMessage">Ingresó un Identificador de Idioma inexistente, regrese al listado haciendo <a href="Main.php?do=contentLanguagesList">click aquí</a></div>
|-/if-|
