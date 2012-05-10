<h2>Boletines</h2>
|-if $notValidId eq "true"-|
<div class="errorMessage">El identificador de la efeméride ingresado no es válido. Seleccione un item del listado.</div>
<input type='button' onClick='location.href="Main.php?do=calendarRegularEventList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Efemérides"/>
|-else-|
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Efeméride</h1>
<div id="div_bulletin">
	<p>Ingrese los datos de la Efeméride</p>
	|-if $message eq "error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar guardar la Efeméride</div>
	|-elseif $message eq "ok"-|
		<div class="successMessage">Cambios guardados correctamente</div>
	|-/if-|
	<form action="Main.php?do=calendarRegularEventDoEdit" method="post">
	<fieldset title="Formulario de edición de datos de una Efeméride">
		<legend>Formulario de Administración de Efemérides</legend>
		<p>
			<label for="params[name]">Nombre</label>
			<input type="text" id="params[name]" name="params[name]" size="10" value="|-$entity->getName()|escape-|" title="Nombre" />
		</p>
		<p>     
			<label for="params[description]">Descripción</label>
			<textarea id="params[description]" name="params[description]" title="Descripción">|-$entity->getDescription()|escape-|</textarea>
		</p>
		<p>     
			<label for="params[date]">Fecha</label>
			<input id="params[date]" name="params[date]" type="text" size="12" value="|-$entity->getDate()|date_format:'%d/%m'-|" />
		</p>
		<p>
			|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$entity->getId()-|" />
			|-/if-|
			<input type="hidden" name="action" id="action" value="|-$action-|" />
			<input type="submit" title="Guardar" value="Guardar" />
			<input type="button" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=calendarRegularEventList'"/>
		</p>
	</fieldset>
	</form>
</div>
|-/if-| <!-- $notValidId eq "true" -->
